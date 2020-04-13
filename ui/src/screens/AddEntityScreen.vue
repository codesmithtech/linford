<template>
    <div class="add-entity screen container">
        <form v-on:submit.prevent="next()">

            <card title="Please provide the name of the new entity" :step="1" :step-in-view="step" @edit="step = $event">
                <div class="form-group">
                    <label for="name" class="form-label">Entity Name</label>
                    <input id="name" type="text" v-model="e.name" required class="form-control" />
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-secondary" @click="step--" v-if="step > 1">Back</button>
                    </div>
                </div>
            </card>


            <card :title="'Describe the properties of ' + e.name" :step="2" :step-in-view="step" @edit="step = $event" table>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Length / Size</th>
                        <th>Nullable</th>
                        <th>Default</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="p in e.properties" v-bind:key="p.id">
                            <td>
                                <input type="text" v-model="p.name" class="form-control" />
                            </td>
                            <td>
                                <select class="form-control" v-model="p.type">
                                    <option v-for="t in dataTypes" :value="t.value" v-bind:key="t.value">{{ t.label }}</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" v-model="p.length" class="form-control" />
                            </td>
                            <td>
                                <select class="form-control" v-model="p.nullable">
                                    <option value="1">Nullable</option>
                                    <option value="0">Not Nullable</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" v-model="p.defaultValue" class="form-control" />
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="row table-button-container">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Next</button>

                        <button type="button" class="btn btn-secondary" v-if="showAddPropsButton">Add another</button>
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-secondary" @click="step--" v-if="step > 1">Back</button>
                    </div>
                </div>
            </card>

            <card :title="'Describe the relationships that ' + e.name + ' has with other entities'" :step="3" :step-in-view="step" @edit="step = $event" table>
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Relationship</th>
                            <th>Related Entity</th>
                            <th>Foreign Key</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="r in e.relationships" v-bind:key="r.relatedEntity + r.foreignKey">
                            <td>{{ e.name }}</td>
                            <td>
                                <select v-model="r.relationshipType" class="form-control" @change="setDefaultForeignKey(r)">
                                    <option v-for="t in relationshipTypes" :value="t.value" v-bind:key="t.value">{{ t.label }}</option>
                                </select>
                            </td>
                            <td>
                                <select v-model="r.relatedEntity" class="form-control" @change="setDefaultForeignKey(r)">
                                    <option v-for="e in allEntities" :value="e.entityName" v-bind:key="e.className">{{ e.entityName }}</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" v-model="r.foreignKey" class="form-control" />
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="row table-button-container">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Next</button>
                        <button type="button" class="btn btn-secondary" @click="addRelationship()">Add One</button>
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-secondary" @click="step--" v-if="step > 1">Back</button>
                    </div>
                </div>
            </card>

            <card :title="'Does ' + e.name + ' have any traits?'" :step="4" :step-in-view="step" @edit="step = $event">
                <div class="selectgroup selectgroup-pills" style="margin-bottom: 30px">
                    <label class="selectgroup-item" v-for="traitName in allTraits" v-bind:key="traitName">
                        <input type="checkbox" :value="traitName" class="selectgroup-input" v-model="e.traits">
                        <span class="selectgroup-button">{{ traitName }}</span>
                    </label>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-secondary" @click="step--" v-if="step > 1">Back</button>
                    </div>
                </div>
            </card>

            <card title="Are any additional indexes on the database table required?" :step="5" :step-in-view="step" @edit="step = $event" table>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Index Type</th>
                            <th>Columns</th>
                            <th>Index Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="i in e.dbIndexes" v-bind:key="i.id">
                            <td>
                                <select class="form-control" v-model="i.indexType" @change="generateIndexName(i)">
                                    <option value="Index">Index</option>
                                    <option value="Unique">Unique</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" v-model="i.columns" multiple @change="generateIndexName(i)">
                                    <option :value="prop" v-for="prop in propertyNames" v-bind:key="prop">{{ prop }}</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" v-model="i.name" />
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="row table-button-container">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Next</button>
                        <button type="button" class="btn btn-secondary" @click="addIndex()">Add One</button>
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-secondary" @click="step--" v-if="step > 1">Back</button>
                    </div>
                </div>
            </card>

            <card title="How should incoming data be validated?" :step="6" :step-in-view="step" @edit="step = $event" table>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Property</th>
                            <th>Type</th>
                            <th>Standard Validators</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="p in e.properties.filter(p => p.name)" v-bind:key="p.id">
                            <td>{{ p.name }}</td>
                            <td>{{ p.type }}</td>
                            <td>
                                <div class="selectgroup selectgroup-pills">
                                    <label class="selectgroup-item" v-for="v in standardValidators" v-bind:key="v">
                                        <input type="checkbox" :value="v" class="selectgroup-input" v-model="p.validators">
                                        <span class="selectgroup-button">{{ v }}</span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="row table-button-container">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-secondary" @click="step--" v-if="step > 1">Back</button>
                    </div>
                </div>
            </card>

            <card :title="'Would you like to generate a policy for ' + e.name + '?'" :step="7" :step-in-view="step" @edit="step = $event">
                <div class="selectgroup selectgroup-pills" style="margin-bottom: 30px">
                    <label class="selectgroup-item">
                        <input type="radio" :value="true" class="selectgroup-input" v-model="e.shouldCreatePolicy">
                        <span class="selectgroup-button">Create a Policy class</span>
                    </label>
                    <label class="selectgroup-item">
                        <input type="radio" :value="false" class="selectgroup-input" v-model="e.shouldCreatePolicy">
                        <span class="selectgroup-button">Do not create a Policy class</span>
                    </label>
                </div>


                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-secondary" @click="step--" v-if="step > 1">Back</button>
                    </div>
                </div>
            </card>

            <card title="Configuration Complete" :step="8" :step-in-view="step">
                <p>You have completed the configuration. Would you like to go ahead and generate source code now?</p>

                <button type="button" class="btn btn-primary" @click="save()" :disabled="loading">Generate Source Code</button>
            </card>
        </form>
    </div>
</template>

<script>
    const propTemplate = {
        id: null,
        name: null,
        type: null,
        length: null,
        nullable: null,
        defaultValue: null,
        validators: [],
    };

    function rand() {
        return Math.round(Math.random() * 100000);
    }

    import Card from "../components/Card";
    import axios from 'axios';

    export default {
        name: 'add-entity-screen',
        components: {Card},

        data() {
            const props = [];
            for (let i = 0; i < 10; i++) {
                props.push({...propTemplate, id: Math.round(Math.random() * 100000)});
            }

            return {
                e: {
                    name: null,
                    properties: props,
                    relationships: [{ id: rand(), relatedEntity: null, relationshipType: null, foreignKey: null,}],
                    traits: [],
                    dbIndexes: [],
                    shouldCreatePolicy: true,
                    createInverseRelations: [],
                },
                step: 1,
                loading: false,
                dataTypes: [
                    { value: 'string', label: 'String' },
                    { value: 'unsignedInteger', label: 'Unsigned Integer' },
                    { value: 'integer', label: 'Signed Integer' },
                    { value: 'dateTime', label: 'Date Time' },
                    { value: 'date', label: 'Date' },
                    { value: 'timestamp', label: 'Timestamp' },
                    { value: 'json', label: 'JSON' },
                    { value: 'boolean', label: 'Boolean' },
                    { value: 'text', label: 'Text' },
                    { value: 'decimal', label: 'Decimal' },
                ],
                relationshipTypes: [
                    { value: 'BelongsTo', label: 'BelongsTo' },
                    { value: 'HasMany', label: 'HasMany' },
                    { value: 'BelongsToMany', label: 'BelongsToMany' },
                    { value: 'HasOne', label: 'HasOne' },
                ],
                allEntities: [],
                allTraits: ['SoftDeletes'],
                standardValidators: ['array', 'date', 'digits', 'email', 'file', 'integer', 'ip', 'json', 'nullable', 'numeric', 'required', 'sometimes', 'string', 'url', 'uuid']
            }
        },

        methods: {
            save() {
                this.loading = true;

                this.e.properties = this.e.properties.filter(p => p.name);

                axios.post('/linford/api/entities', this.e).then(r => {
                    console.log(r);
                }).finally(() => {
                    this.loading = false;
                })
            },
            next() {
                this.step++;
            },
            addRelationship() {
                this.e.relationships.push({ id: rand(), relatedEntity: null, relationshipType: null, foreignKey: null,});
            },
            addIndex() {
                this.e.dbIndexes.push({ id: rand(), indexType: null, columns: [], name: null});
            },
            setDefaultForeignKey(rel) {
                if (! rel.relationshipType || ! rel.relatedEntity) {
                    return;
                }

                if (rel.relationshipType.startsWith('Belongs')) {
                    rel.foreignKey = rel.relatedEntity[0].toLowerCase() + rel.relatedEntity.slice(1) + 'Id';
                } else if (rel.relationshipType.startsWith('Has')) {
                    rel.foreignKey = this.e.name[0].toLowerCase() + this.e.name.slice(1) + 'Id';
                }
            },
            generateIndexName(idx) {
                if (! idx.indexType || ! idx.columns || idx.columns.length < 1) {
                    return;
                }

                idx.name = idx.indexType.toLowerCase() + '_' + idx.columns.join('_').toLowerCase();
            }
        },

        computed: {
            showAddPropsButton() {
                return this.e.properties[this.e.properties.length - 1].name !== null;
            },
            propertyNames() {
                return this.e.properties.filter(p => p.name).map(p => p.name);
            }
        },

        watch: {
            e: {
                handler(v) {
                    if (v && v.name) {
                        window.sessionStorage.setItem('linford', JSON.stringify({ e: this.e, step: this.step }));
                    }
                },
                deep: true,
            },
            step: {
                handler() {
                    window.sessionStorage.setItem('linford', JSON.stringify({ e: this.e, step: this.step }));
                },
            }
        },

        mounted() {
            const fromCache = window.sessionStorage.getItem('linford');

            if (fromCache) {
                const decoded = JSON.parse(fromCache);
                for (const k of Object.keys(decoded)) {
                    this[k] = decoded[k];
                }
            }

            axios.get('/linford/api/entities').then(r => {
                this.allEntities = r.data;
            });
        }
    }
</script>

<style>
    .table-button-container {
        padding: 0 20px 20px 20px;
    }
</style>