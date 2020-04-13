(function(t){function e(e){for(var n,r,o=e[0],l=e[1],u=e[2],d=0,p=[];d<o.length;d++)r=o[d],Object.prototype.hasOwnProperty.call(s,r)&&s[r]&&p.push(s[r][0]),s[r]=0;for(n in l)Object.prototype.hasOwnProperty.call(l,n)&&(t[n]=l[n]);c&&c(e);while(p.length)p.shift()();return i.push.apply(i,u||[]),a()}function a(){for(var t,e=0;e<i.length;e++){for(var a=i[e],n=!0,o=1;o<a.length;o++){var l=a[o];0!==s[l]&&(n=!1)}n&&(i.splice(e--,1),t=r(r.s=a[0]))}return t}var n={},s={app:0},i=[];function r(e){if(n[e])return n[e].exports;var a=n[e]={i:e,l:!1,exports:{}};return t[e].call(a.exports,a,a.exports,r),a.l=!0,a.exports}r.m=t,r.c=n,r.d=function(t,e,a){r.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:a})},r.r=function(t){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},r.t=function(t,e){if(1&e&&(t=r(t)),8&e)return t;if(4&e&&"object"===typeof t&&t&&t.__esModule)return t;var a=Object.create(null);if(r.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var n in t)r.d(a,n,function(e){return t[e]}.bind(null,n));return a},r.n=function(t){var e=t&&t.__esModule?function(){return t["default"]}:function(){return t};return r.d(e,"a",e),e},r.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},r.p="/vendor/linford/";var o=window["webpackJsonp"]=window["webpackJsonp"]||[],l=o.push.bind(o);o.push=e,o=o.slice();for(var u=0;u<o.length;u++)e(o[u]);var c=l;i.push([0,"chunk-vendors"]),a()})({0:function(t,e,a){t.exports=a("56d7")},"034f":function(t,e,a){"use strict";var n=a("85ec"),s=a.n(n);s.a},"1bc8":function(t,e,a){},"56d7":function(t,e,a){"use strict";a.r(e);a("e260"),a("e6cf"),a("cca6"),a("a79d");var n=a("2b0e"),s=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{attrs:{id:"app"}},[a("h1",[t._v("LINFORD")]),a("AddEntityScreen")],1)},i=[],r=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"add-entity screen container"},[a("form",{on:{submit:function(e){return e.preventDefault(),t.next()}}},[a("card",{attrs:{title:"Please provide the name of the new entity",step:1,"step-in-view":t.step},on:{edit:function(e){t.step=e}}},[a("div",{staticClass:"form-group"},[a("label",{staticClass:"form-label",attrs:{for:"name"}},[t._v("Entity Name")]),a("input",{directives:[{name:"model",rawName:"v-model",value:t.e.name,expression:"e.name"}],staticClass:"form-control",attrs:{id:"name",type:"text",required:""},domProps:{value:t.e.name},on:{input:function(e){e.target.composing||t.$set(t.e,"name",e.target.value)}}})]),a("div",{staticClass:"row"},[a("div",{staticClass:"col"},[a("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[t._v("Next")])]),a("div",{staticClass:"col text-right"},[t.step>1?a("button",{staticClass:"btn btn-secondary",attrs:{type:"button"},on:{click:function(e){t.step--}}},[t._v("Back")]):t._e()])])]),a("card",{attrs:{title:"Describe the properties of "+t.e.name,step:2,"step-in-view":t.step,table:""},on:{edit:function(e){t.step=e}}},[a("table",{staticClass:"table table-striped"},[a("thead",[a("tr",[a("th",[t._v("Name")]),a("th",[t._v("Type")]),a("th",[t._v("Length / Size")]),a("th",[t._v("Nullable")]),a("th",[t._v("Default")])])]),a("tbody",t._l(t.e.properties,(function(e){return a("tr",{key:e.id},[a("td",[a("input",{directives:[{name:"model",rawName:"v-model",value:e.name,expression:"p.name"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:e.name},on:{input:function(a){a.target.composing||t.$set(e,"name",a.target.value)}}})]),a("td",[a("select",{directives:[{name:"model",rawName:"v-model",value:e.type,expression:"p.type"}],staticClass:"form-control",on:{change:function(a){var n=Array.prototype.filter.call(a.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.$set(e,"type",a.target.multiple?n:n[0])}}},t._l(t.dataTypes,(function(e){return a("option",{key:e.value,domProps:{value:e.value}},[t._v(t._s(e.label))])})),0)]),a("td",[a("input",{directives:[{name:"model",rawName:"v-model",value:e.length,expression:"p.length"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:e.length},on:{input:function(a){a.target.composing||t.$set(e,"length",a.target.value)}}})]),a("td",[a("select",{directives:[{name:"model",rawName:"v-model",value:e.nullable,expression:"p.nullable"}],staticClass:"form-control",on:{change:function(a){var n=Array.prototype.filter.call(a.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.$set(e,"nullable",a.target.multiple?n:n[0])}}},[a("option",{attrs:{value:"1"}},[t._v("Nullable")]),a("option",{attrs:{value:"0"}},[t._v("Not Nullable")])])]),a("td",[a("input",{directives:[{name:"model",rawName:"v-model",value:e.defaultValue,expression:"p.defaultValue"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:e.defaultValue},on:{input:function(a){a.target.composing||t.$set(e,"defaultValue",a.target.value)}}})])])})),0)]),a("div",{staticClass:"row table-button-container"},[a("div",{staticClass:"col"},[a("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[t._v("Next")]),t.showAddPropsButton?a("button",{staticClass:"btn btn-secondary",attrs:{type:"button"}},[t._v("Add another")]):t._e()]),a("div",{staticClass:"col text-right"},[t.step>1?a("button",{staticClass:"btn btn-secondary",attrs:{type:"button"},on:{click:function(e){t.step--}}},[t._v("Back")]):t._e()])])]),a("card",{attrs:{title:"Describe the relationships that "+t.e.name+" has with other entities",step:3,"step-in-view":t.step,table:""},on:{edit:function(e){t.step=e}}},[a("table",{staticClass:"table"},[a("thead",[a("tr",[a("th"),a("th",[t._v("Relationship")]),a("th",[t._v("Related Entity")]),a("th",[t._v("Foreign Key")])])]),a("tbody",t._l(t.e.relationships,(function(e){return a("tr",{key:e.relatedEntity+e.foreignKey},[a("td",[t._v(t._s(t.e.name))]),a("td",[a("select",{directives:[{name:"model",rawName:"v-model",value:e.relationshipType,expression:"r.relationshipType"}],staticClass:"form-control",on:{change:[function(a){var n=Array.prototype.filter.call(a.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.$set(e,"relationshipType",a.target.multiple?n:n[0])},function(a){return t.setDefaultForeignKey(e)}]}},t._l(t.relationshipTypes,(function(e){return a("option",{key:e.value,domProps:{value:e.value}},[t._v(t._s(e.label))])})),0)]),a("td",[a("select",{directives:[{name:"model",rawName:"v-model",value:e.relatedEntity,expression:"r.relatedEntity"}],staticClass:"form-control",on:{change:[function(a){var n=Array.prototype.filter.call(a.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.$set(e,"relatedEntity",a.target.multiple?n:n[0])},function(a){return t.setDefaultForeignKey(e)}]}},t._l(t.allEntities,(function(e){return a("option",{key:e.className,domProps:{value:e.entityName}},[t._v(t._s(e.entityName))])})),0)]),a("td",[a("input",{directives:[{name:"model",rawName:"v-model",value:e.foreignKey,expression:"r.foreignKey"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:e.foreignKey},on:{input:function(a){a.target.composing||t.$set(e,"foreignKey",a.target.value)}}})])])})),0)]),a("div",{staticClass:"row table-button-container"},[a("div",{staticClass:"col"},[a("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[t._v("Next")]),a("button",{staticClass:"btn btn-secondary",attrs:{type:"button"},on:{click:function(e){return t.addRelationship()}}},[t._v("Add One")])]),a("div",{staticClass:"col text-right"},[t.step>1?a("button",{staticClass:"btn btn-secondary",attrs:{type:"button"},on:{click:function(e){t.step--}}},[t._v("Back")]):t._e()])])]),a("card",{attrs:{title:"Does "+t.e.name+" have any traits?",step:4,"step-in-view":t.step},on:{edit:function(e){t.step=e}}},[a("div",{staticClass:"selectgroup selectgroup-pills",staticStyle:{"margin-bottom":"30px"}},t._l(t.allTraits,(function(e){return a("label",{key:e,staticClass:"selectgroup-item"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.e.traits,expression:"e.traits"}],staticClass:"selectgroup-input",attrs:{type:"checkbox"},domProps:{value:e,checked:Array.isArray(t.e.traits)?t._i(t.e.traits,e)>-1:t.e.traits},on:{change:function(a){var n=t.e.traits,s=a.target,i=!!s.checked;if(Array.isArray(n)){var r=e,o=t._i(n,r);s.checked?o<0&&t.$set(t.e,"traits",n.concat([r])):o>-1&&t.$set(t.e,"traits",n.slice(0,o).concat(n.slice(o+1)))}else t.$set(t.e,"traits",i)}}}),a("span",{staticClass:"selectgroup-button"},[t._v(t._s(e))])])})),0),a("div",{staticClass:"row"},[a("div",{staticClass:"col"},[a("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[t._v("Next")])]),a("div",{staticClass:"col text-right"},[t.step>1?a("button",{staticClass:"btn btn-secondary",attrs:{type:"button"},on:{click:function(e){t.step--}}},[t._v("Back")]):t._e()])])]),a("card",{attrs:{title:"Are any additional indexes on the database table required?",step:5,"step-in-view":t.step,table:""},on:{edit:function(e){t.step=e}}},[a("table",{staticClass:"table"},[a("thead",[a("tr",[a("th",[t._v("Index Type")]),a("th",[t._v("Columns")]),a("th",[t._v("Index Name")])])]),a("tbody",t._l(t.e.dbIndexes,(function(e){return a("tr",{key:e.id},[a("td",[a("select",{directives:[{name:"model",rawName:"v-model",value:e.indexType,expression:"i.indexType"}],staticClass:"form-control",on:{change:[function(a){var n=Array.prototype.filter.call(a.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.$set(e,"indexType",a.target.multiple?n:n[0])},function(a){return t.generateIndexName(e)}]}},[a("option",{attrs:{value:"Index"}},[t._v("Index")]),a("option",{attrs:{value:"Unique"}},[t._v("Unique")])])]),a("td",[a("select",{directives:[{name:"model",rawName:"v-model",value:e.columns,expression:"i.columns"}],staticClass:"form-control",attrs:{multiple:""},on:{change:[function(a){var n=Array.prototype.filter.call(a.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.$set(e,"columns",a.target.multiple?n:n[0])},function(a){return t.generateIndexName(e)}]}},t._l(t.propertyNames,(function(e){return a("option",{key:e,domProps:{value:e}},[t._v(t._s(e))])})),0)]),a("td",[a("input",{directives:[{name:"model",rawName:"v-model",value:e.name,expression:"i.name"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:e.name},on:{input:function(a){a.target.composing||t.$set(e,"name",a.target.value)}}})])])})),0)]),a("div",{staticClass:"row table-button-container"},[a("div",{staticClass:"col"},[a("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[t._v("Next")]),a("button",{staticClass:"btn btn-secondary",attrs:{type:"button"},on:{click:function(e){return t.addIndex()}}},[t._v("Add One")])]),a("div",{staticClass:"col text-right"},[t.step>1?a("button",{staticClass:"btn btn-secondary",attrs:{type:"button"},on:{click:function(e){t.step--}}},[t._v("Back")]):t._e()])])]),a("card",{attrs:{title:"How should incoming data be validated?",step:6,"step-in-view":t.step,table:""},on:{edit:function(e){t.step=e}}},[a("table",{staticClass:"table"},[a("thead",[a("tr",[a("th",[t._v("Property")]),a("th",[t._v("Type")]),a("th",[t._v("Standard Validators")])])]),a("tbody",t._l(t.e.properties.filter((function(t){return t.name})),(function(e){return a("tr",{key:e.id},[a("td",[t._v(t._s(e.name))]),a("td",[t._v(t._s(e.type))]),a("td",[a("div",{staticClass:"selectgroup selectgroup-pills"},t._l(t.standardValidators,(function(n){return a("label",{key:n,staticClass:"selectgroup-item"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.validators,expression:"p.validators"}],staticClass:"selectgroup-input",attrs:{type:"checkbox"},domProps:{value:n,checked:Array.isArray(e.validators)?t._i(e.validators,n)>-1:e.validators},on:{change:function(a){var s=e.validators,i=a.target,r=!!i.checked;if(Array.isArray(s)){var o=n,l=t._i(s,o);i.checked?l<0&&t.$set(e,"validators",s.concat([o])):l>-1&&t.$set(e,"validators",s.slice(0,l).concat(s.slice(l+1)))}else t.$set(e,"validators",r)}}}),a("span",{staticClass:"selectgroup-button"},[t._v(t._s(n))])])})),0)])])})),0)]),a("div",{staticClass:"row table-button-container"},[a("div",{staticClass:"col"},[a("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[t._v("Next")])]),a("div",{staticClass:"col text-right"},[t.step>1?a("button",{staticClass:"btn btn-secondary",attrs:{type:"button"},on:{click:function(e){t.step--}}},[t._v("Back")]):t._e()])])]),a("card",{attrs:{title:"Would you like to generate a policy for "+t.e.name+"?",step:7,"step-in-view":t.step},on:{edit:function(e){t.step=e}}},[a("div",{staticClass:"selectgroup selectgroup-pills",staticStyle:{"margin-bottom":"30px"}},[a("label",{staticClass:"selectgroup-item"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.e.shouldCreatePolicy,expression:"e.shouldCreatePolicy"}],staticClass:"selectgroup-input",attrs:{type:"radio"},domProps:{value:!0,checked:t._q(t.e.shouldCreatePolicy,!0)},on:{change:function(e){return t.$set(t.e,"shouldCreatePolicy",!0)}}}),a("span",{staticClass:"selectgroup-button"},[t._v("Create a Policy class")])]),a("label",{staticClass:"selectgroup-item"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.e.shouldCreatePolicy,expression:"e.shouldCreatePolicy"}],staticClass:"selectgroup-input",attrs:{type:"radio"},domProps:{value:!1,checked:t._q(t.e.shouldCreatePolicy,!1)},on:{change:function(e){return t.$set(t.e,"shouldCreatePolicy",!1)}}}),a("span",{staticClass:"selectgroup-button"},[t._v("Do not create a Policy class")])])]),a("div",{staticClass:"row"},[a("div",{staticClass:"col"},[a("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[t._v("Next")])]),a("div",{staticClass:"col text-right"},[t.step>1?a("button",{staticClass:"btn btn-secondary",attrs:{type:"button"},on:{click:function(e){t.step--}}},[t._v("Back")]):t._e()])])]),a("card",{attrs:{title:"Configuration Complete",step:8,"step-in-view":t.step}},[a("p",[t._v("You have completed the configuration. Would you like to go ahead and generate source code now?")]),a("button",{staticClass:"btn btn-primary",attrs:{type:"button",disabled:t.loading},on:{click:function(e){return t.save()}}},[t._v("Generate Source Code")])])],1)])},o=[],l=(a("4de4"),a("a15b"),a("d81d"),a("fb6a"),a("b0c0"),a("b64b"),a("d3b7"),a("2ca0"),a("5530")),u=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"card",class:{"card-collapsed":!t.shouldBeExpanded,hidden:t.stepInView<t.step}},[t.title?a("div",{staticClass:"card-header"},[a("h3",{staticClass:"card-title"},[t._v(t._s(t.title))]),t.subtitle?a("div",{staticClass:"card-subtitle"},[t._v(t._s(t.subtitle))]):t._e(),a("div",{staticClass:"card-options"},[t.shouldBeExpanded?t._e():a("button",{staticClass:"btn btn-secondary btn-sm",attrs:{type:"button"},on:{click:function(e){return t.$emit("edit",t.step)}}},[t._v("Edit")])])]):t._e(),a("div",{class:!0===t.table?"card-table":"card-body"},[t._t("default")],2),t.showFooter?a("div",{staticClass:"card-footer"},[t._t("footer")],2):t._e()])},c=[],d=(a("a9e3"),{name:"card",computed:{showFooter:function(){return!!this.$slots.footer},shouldBeExpanded:function(){return!this.step||!this.stepInView||this.step===this.stepInView}},props:{title:{type:String,required:!1,default:null},subtitle:{type:String,required:!1,default:null},table:{required:!1,type:Boolean,default:!1},step:{required:!1,type:Number},stepInView:{required:!1,type:Number}}}),p=d,v=(a("e60d"),a("2877")),m=Object(v["a"])(p,u,c,!1,null,null,null),f=m.exports,b=a("bc3a"),y=a.n(b),h={id:null,name:null,type:null,length:null,nullable:null,defaultValue:null,validators:[]};function g(){return Math.round(1e5*Math.random())}var _={name:"add-entity-screen",components:{Card:f},data:function(){for(var t=[],e=0;e<10;e++)t.push(Object(l["a"])({},h,{id:Math.round(1e5*Math.random())}));return{e:{name:null,properties:t,relationships:[{id:g(),relatedEntity:null,relationshipType:null,foreignKey:null}],traits:[],dbIndexes:[],shouldCreatePolicy:!0,createInverseRelations:[]},step:1,loading:!1,dataTypes:[{value:"string",label:"String"},{value:"unsignedInteger",label:"Unsigned Integer"},{value:"integer",label:"Signed Integer"},{value:"dateTime",label:"Date Time"},{value:"date",label:"Date"},{value:"timestamp",label:"Timestamp"},{value:"json",label:"JSON"},{value:"boolean",label:"Boolean"},{value:"text",label:"Text"},{value:"decimal",label:"Decimal"}],relationshipTypes:[{value:"BelongsTo",label:"BelongsTo"},{value:"HasMany",label:"HasMany"},{value:"BelongsToMany",label:"BelongsToMany"},{value:"HasOne",label:"HasOne"}],allEntities:[],allTraits:["SoftDeletes"],standardValidators:["array","date","digits","email","file","integer","ip","json","nullable","numeric","required","sometimes","string","url","uuid"]}},methods:{save:function(){var t=this;this.loading=!0,this.e.properties=this.e.properties.filter((function(t){return t.name})),y.a.post("/linford/api/entities",this.e).then((function(t){console.log(t)})).finally((function(){t.loading=!1}))},next:function(){this.step++},addRelationship:function(){this.e.relationships.push({id:g(),relatedEntity:null,relationshipType:null,foreignKey:null})},addIndex:function(){this.e.dbIndexes.push({id:g(),indexType:null,columns:[],name:null})},setDefaultForeignKey:function(t){t.relationshipType&&t.relatedEntity&&(t.relationshipType.startsWith("Belongs")?t.foreignKey=t.relatedEntity[0].toLowerCase()+t.relatedEntity.slice(1)+"Id":t.relationshipType.startsWith("Has")&&(t.foreignKey=this.e.name[0].toLowerCase()+this.e.name.slice(1)+"Id"))},generateIndexName:function(t){!t.indexType||!t.columns||t.columns.length<1||(t.name=t.indexType.toLowerCase()+"_"+t.columns.join("_").toLowerCase())}},computed:{showAddPropsButton:function(){return null!==this.e.properties[this.e.properties.length-1].name},propertyNames:function(){return this.e.properties.filter((function(t){return t.name})).map((function(t){return t.name}))}},watch:{e:{handler:function(t){t&&t.name&&window.sessionStorage.setItem("linford",JSON.stringify({e:this.e,step:this.step}))},deep:!0},step:{handler:function(){window.sessionStorage.setItem("linford",JSON.stringify({e:this.e,step:this.step}))}}},mounted:function(){var t=this,e=window.sessionStorage.getItem("linford");if(e)for(var a=JSON.parse(e),n=0,s=Object.keys(a);n<s.length;n++){var i=s[n];this[i]=a[i]}y.a.get("/linford/api/entities").then((function(e){t.allEntities=e.data}))}},C=_,x=(a("852d"),Object(v["a"])(C,r,o,!1,null,null,null)),w=x.exports,N={name:"App",components:{AddEntityScreen:w}},k=N,P=(a("034f"),Object(v["a"])(k,s,i,!1,null,null,null)),T=P.exports,I=a("2f62");n["a"].use(I["a"]);var $=new I["a"].Store({state:{},mutations:{},actions:{},modules:{}});n["a"].config.productionTip=!1,new n["a"]({store:$,render:function(t){return t(T)}}).$mount("#app")},"852d":function(t,e,a){"use strict";var n=a("1bc8"),s=a.n(n);s.a},"85ec":function(t,e,a){},e60d:function(t,e,a){"use strict";var n=a("e9ec"),s=a.n(n);s.a},e9ec:function(t,e,a){}});
//# sourceMappingURL=app.38b039ea.js.map