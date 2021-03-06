<?php
/** @var \kmucms\uipages\PageWeb $this */
$this->setPageEnvelope();

$this->setData('title', 'DataPool: Objekte definieren');
$this->getWeblib()->addJs('/files/node_modules/vue/dist/vue.min.js');
?>

<div class="container">

  <?=
  $this->getComponent('bootstrap/breadcrumb', [
    'crumb'   => [
      'Admin'    => '/admin',
      'Datapool' => '/admin/datapool',
    ],
    'current' => 'Hauptobjekte'
  ])
  ?>

  <div id="data" 
       data-json="<?= htmlentities(json_encode(\kmucms\datapool\DataPool::getInstance()->getModel())) ?>" 
       data-types="<?= htmlentities(json_encode(\kmucms\datapool\DataPool::getInstance()->getPropertyTypes())) ?>"
       ></div>

  <div id="app">
    <div class="row align-items-center">
      <div class="col-auto" style="flex-grow: 1">
        <label><input v-model="editor_showAttr" type="checkbox"/> Objekt-Art</label><br/>
        <label><input v-model="editor_showProp" type="checkbox"/> Objekt-Eigenschaften</label><br/>
        <label><input v-model="editor_showMain" type="checkbox"/> Seitenobjekte</label><br/>
        <label><input v-model="editor_showSubMain" type="checkbox"/> Hilfsobjekte</label><br/>
      </div>
      <div class="col-auto">
        <button v-on:click="compile" class="btn btn-primary mb-2">Kompilieren</button>
        <button v-on:click="saveAll" class="btn btn-success mb-2">Speichern</button>
      </div>
    </div>

    <div  style="overflow: auto;" class="bg-white border rounded">
      <div 
        v-for="(obj,objKey) in modeldata.model.objects" 
        v-if="obj.attributes.main && editor_showMain || !obj.attributes.main && editor_showSubMain" 
        class="p-2  m-2 border  text-white rounded"
        v-bind:class=" obj.attributes.main ? 'bg-dark' : 'bg-secondary'"
        >
        <div>
          <label><input v-model="obj.editor_edit"  type="checkbox"/> {{obj.name}}</label>
          <span class="float-right">
            <i v-on:click="moveItem(modeldata.model.objects,objKey,objKey-1)" v-if="objKey>0" class="bi-arrow-up p-1"></i>
            <i v-on:click="moveItem(modeldata.model.objects,objKey,objKey+1)" v-if="objKey<(modeldata.model.objects.length-1)" class="bi-arrow-down p-1"></i>
            <i v-on:click="deleteItem(modeldata.model.objects,objKey)" class="bi-trash p-1"></i>
          </span>
        </div>
        <div v-if="obj.editor_edit">
          <div>
            name<br/>
            <input v-model="obj.name" type="text" class="">
          </div>
          <div>
            label<br/>
            <input v-model="obj.label" type="text" class="">
          </div>
          <div>
            <table v-if="editor_showProp" class="ml-3">
              <tr v-for="(property,pkey) in obj.properties">
                <td>name:</td><td><input v-model="property.name" type="text" class=""></td>
                <td>label:</td><td><input v-model="property.label" type="text" class=""></td>
                <td>type:</td><td>
                  <select v-model="property.type">
                    <option v-for="(option,oindex) in editor_propertyTypes" v-bind:value="oindex">
                      {{ option }}
                    </option>
                  </select>
                </td>
                <td>
                  <i v-on:click="moveItem(obj.properties,pkey,pkey-1)" v-if="pkey>0" class="bi-arrow-up p-1"></i><i v-if="pkey==0" class="bi-record p-1"></i>
                  <i v-on:click="moveItem(obj.properties,pkey,pkey+1)" v-if="pkey<(obj.properties.length-1)" class="bi-arrow-down p-1"></i><i v-if="pkey==(obj.properties.length-1)" class="bi-record p-1"></i>
                  <i v-on:click="deleteItem(obj.properties,pkey)" class="bi-trash p-1"></i>
                </td>
              </tr>
              <tr><td colspan="4"><input  v-on:keyup.13="addObjProperty(obj.properties,$event.target.value);$event.target.value=''" /><i class="bi-plus"></i></td></tr>
            </table>
            <div v-if="editor_showAttr" class="ml-3">
              <label><input type="checkbox" v-model="obj.attributes.main" /> Seitenobjekt</label>
            </div>
          </div>
        </div>    <!-- EDIT NODE -->
        <div v-else>
          {{ obj.label }}
          <ul v-if="editor_showProp">
            <li v-for="(property,pkey) in obj.properties">
              {{property.label}}
            </li>
          </ul>
          <ul v-if="editor_showAttr">
            <li v-for="(property,pkey) in obj.attributes" v-if="property" style="list-style-type: square;">
              {{pkey}}
            </li>
          </ul>
        </div>
      </div>
      <div class="p-2  m-2 border bg-secondary text-white rounded">
        <div class="form-row align-items-center">
          <div class="col-auto">
            <label class="sr-only" for="inlineFormInput">Name</label>
            <input v-model="editor_newname" type="text" class="form-control mb-2" placeholder="" v-on:keyup.13="addObj">
          </div>
          <div class="col-auto">
            <button v-on:click="addObj" class="btn btn-primary mb-2">Neu</button>
          </div>
        </div>
      </div>
    </div>

  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function (event) {

      Array.prototype.move = function (from, to) {
        this.splice(to, 0, this.splice(from, 1)[0]);
        return this;
      };

      var app = new Vue({
        el: '#app',
        data: {
          editor_newname: '',
          editor_showProp: false,
          editor_showAttr: false,
          editor_showMain: true,
          editor_showSubMain: false,
          editor_propertyTypes: {}, //to be loaded
          modeldata: {}  //to be loaded
        },
        methods: {
          addObj: function () {
            function hasProperty(arr, name) {
              for (let x in arr) {
                if (arr[x].name == name) {
                  return true;
                }
              }
              return false;
            }
            if (this.editor_newname != '' && !hasProperty(this.modeldata.model.objects, this.editor_newname)) {//this.modeldata.model.objects.hasOwnProperty(this.editor_newname)) {
              //this.$set(this.modeldata.model.objects, this.editor_newname, {'label': this.editor_newname, name: this.editor_newname});
              this.modeldata.model.objects.push({'label': this.editor_newname, name: this.editor_newname, properties: [], attributes: {}});
            }
            this.editor_newname = '';
          },
          saveAll() {
            let model = this.modeldata;
            let objects = model.model.objects;

            model.model.objects = {};
            for (x in objects) {
              let props = objects[x].properties;
              objects[x].properties = {}
              for (y in props) {
                objects[x].properties[props[y].name] = props[y];
              }
              model.model.objects[objects[x].name] = objects[x];
            }
            $.post('/admin/datapool/edit/savemodel/', {'model': JSON.stringify(model)});
          },
          compile() {
            $.post('/admin/datapool/edit/compilemodel/', {'model': JSON.stringify(this.modeldata)});
          },
          deleteItem(arr, index) {
            this.$delete(arr, index);
          },
          moveItem(arr, from, to) {
            arr.move(from, to);
          },
          addObjProperty(arrProperties, name) {
            arrProperties.push({'name': name, 'label': name});
          }
        },
        created: function () {
          let div = document.getElementById('data');
          let obj = JSON.parse(div.dataset.json);
          function nameFromKey(obj) {
            if (Array.isArray(obj)) {
              return obj;
            }
            let arr = [];
            for (let x in obj) {
              obj[x].name = x;
              arr.push(obj[x]);
            }
            return arr;
          }
          obj.model.objects = nameFromKey(obj.model.objects);
          for (let x in obj.model.objects) {
            obj.model.objects[x].properties = nameFromKey(obj.model.objects[x].properties);
            if (!obj.model.objects[x].hasOwnProperty('attributes')) {
              obj.model.objects[x]['attributes'] = {'main': false};
            }
          }
          this.modeldata = obj;

          this.editor_propertyTypes = JSON.parse(div.dataset.types);

        }
      });
    }
    );
  </script>

</div>