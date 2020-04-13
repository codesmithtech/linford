<template>
    <div class="card" :class="{ 'card-collapsed': !shouldBeExpanded, 'hidden': stepInView < step }">
        <div class="card-header" v-if="title">
            <h3 class="card-title">{{ title }}</h3>
            <div v-if="subtitle" class="card-subtitle">{{ subtitle }}</div>
            <div class="card-options">
                <button v-if="!shouldBeExpanded" type="button" class="btn btn-secondary btn-sm" @click="$emit('edit', step)">Edit</button>
            </div>
        </div>

        <div :class="table === true ? 'card-table' : 'card-body'">
            <slot></slot>
        </div>

        <div class="card-footer" v-if="showFooter">
            <slot name="footer"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'card',

        computed: {
            showFooter() {
                return !!this.$slots.footer;
            },
            shouldBeExpanded() {
                if (! this.step || ! this.stepInView) {
                    return true;
                }

                if (this.step !== this.stepInView) {
                    return false;
                }

                return true;
            }
        },

        props: {
            title: {
                type: String,
                required: false,
                default: null,
            },
            subtitle: {
                type: String,
                required: false,
                default: null,
            },
            table: {
                required: false,
                type: Boolean,
                default: false,
            },
            step: {
                required: false,
                type: Number,
            },
            stepInView: {
                required: false,
                type: Number,
            }
        },
    }
</script>

<style lang="scss">
    .card > .card-header > .card-subtitle {
        margin: 0 0 0 15px;
        font-size: 0.8rem;
        display: none;

        @media (min-width: 768px) {
            display: block;
        }
    }

    .card.hidden {
        display: none;
    }
</style>