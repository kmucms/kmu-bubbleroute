<?php
/** @var \kmucms\uipages\PageWeb $this */
$this->setPageEnvelope();

$this->setData('title', 'DataPool: Hauptobjekte bearbeiten');
$this->weblib()->addJs('/weblib/node_modules/vue/dist/vue.min.js');
?>

<div class="container">

  <?=
  $this->getComponent('bootstrap/breadcrumb', [
    'crumb' => [
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
        <label><input v-model="editor_showProp" type="checkbox"/> Eigenschaften anzeigen</label>
      </div>
      <div class="col-auto">
        <button v-on:click="saveAll" class="btn btn-success mb-2">Speichern</button>
      </div>
    </div>

    <div  style="overflow: auto;" class="bg-white border rounded">
      <div class="p-2  m-2 border bg-secondary text-white rounded" v-for="(obj,objKey) in modeldata.model.objects">
        <div><label><input v-model="obj.editor_edit"  type="checkbox"/> {{obj.name}}</label></div>
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
              </tr>
            </table>
          </div>
        </div>    <!-- EDIT NODE -->
        <div v-else>
          {{ obj.label }}
          <ul v-if="editor_showProp">
            <li v-for="(property,pkey) in obj.properties">
              {{property.label}}
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
      var app = new Vue({
        el: '#app',
        data: {
          editor_newname: '',
          editor_showProp: false,
          editor_propertyTypes: {}, //to be loaded
          modeldata: {}  //to be loaded
        },
        methods: {
          addObj: function () {
            if (this.editor_newname != '' && !this.modeldata.model.objects.hasOwnProperty(this.editor_newname)) {
              this.$set(this.modeldata.model.objects, this.editor_newname, {'label': this.editor_newname, name: this.editor_newname});
            }
            this.editor_newname = '';
          },
          saveAll() {
            alert(JSON.stringify(this.modeldata));
          }
        },
        created: function () {
          let div = document.getElementById('data');
          let obj = JSON.parse(div.dataset.json);
          function nameFromKey(obj) {
            for (let x in obj) {
              obj[x].name = x;
            }
            return obj;
          }
          obj.model.objects = nameFromKey(obj.model.objects);
          for (let x in obj.model.objects) {
            obj.model.objects[x].properties = nameFromKey(obj.model.objects[x].properties);
          }
          this.modeldata = obj;

          this.editor_propertyTypes = JSON.parse(div.dataset.types);

        }
      });
    }
    );
  </script>

</div>