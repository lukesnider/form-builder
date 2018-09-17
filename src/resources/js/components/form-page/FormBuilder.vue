<template>
<div>
  <div class="row mt-5">
    <div class="col">
      <h2>{{formTitle}}</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-8">
      <Container class="list-item-container" :group-name="'1'" :get-child-payload="getChildPayload2" @drop="onDrop('elementList', $event)">
        <Draggable :data-delete="element.uid" v-for="element in elementList" :key="element.uid">
          <div class="the-element">
            <div class="element-actions">
              <div v-if="element.uid != 'SUBMITBUTTON'" @click="removeElement(element, $event)" class="delete clickable"><i class="fas fa-times"></i></div>
              <div  @click="editElement(element, $event)" class="edit clickable"><i class="fas fa-ellipsis-h"></i></div>
            </div>
            <div class="form-element draggable-item">
              <div class="element-inner">
                <div class="form-group" style="width: 100%;">
                  <span class="element-span-container" :style="{'justify-content': element.styles.justify}" v-html="getElementContent(element)"></span>
                </div>
              </div>
            </div>
          </div>
        </Draggable>
      </Container>
    </div>
    <div v-if="editElementShow" class="col-4">

      <div class="form-group">
        <button @click="doneEdit()" type="button" class="btn btn-dark">Update</button>
      </div>
    </div>
    <div v-else class="col-3">
      <Container class="list-item-container" :behaviour="'copy'"  :group-name="'1'" :get-child-payload="getChildPayload1">
        <Draggable v-for="widget in widgetList" :key="widget.id">
          <div class="shadow-md form-widget widget draggable-item">
            <div class="">
              <div>{{widget.name}}</div>
              <div><i :class="widget.icon"></i></div>
            </div>
          </div>
        </Draggable>
      </Container>
    </div>
  </div>
  <div class="row">
    <div class="col-2">
      <button @click="saveForm()" type="button" class="btn btn-dark">Save</button>
    </div>
  </div>
</div>
</template>


<script>
var _ = require('lodash');
import { Container, Draggable } from "vue-smooth-dnd";
import { applyDrag, generateItems } from "./utils";
import axios from 'axios';
import Qs from 'qs';
import PaddingControl from './controls/Padding.vue'

export default {
    data () {
      return {
        widgetList: formBuilderData.form_widgets,
        elementList: [
          //{
          //  id: 'submit-button',
          //  uid: 'SUBMITBUTTON',
          //  placeholder: 'Submit',
          //  tag: 'input',
          //  type: 'submit',
          //  styles: {
          //    width: 100,
          //    width_type: '%',
          //    margin: {
          //        top: 0,
          //        right: 0,
          //        bottom: 0,
          //        left: 0,
          //    },
          //    padding: {
          //        top: 8,
          //        right: 8,
          //        bottom: 8,
          //        left: 8,
          //    },
          //    justify: 'center',
          //  }
          //}
        ],
        formTitle: 'New Form',
        editElementShow: false,
        selectedElement: {
          name: 'test',
          width: 100
        }
      }
    },
    methods: {
      onDrop: function(collection, dropResult) {
        this[collection] = applyDrag(this[collection], dropResult);
        this.editElementShow = false
      },
      getChildPayload1: function(index) {
        var element =  _.cloneDeep(this.widgetList[index])
        element.uid = this.randomId()
        return element
      },
      getChildPayload2: function(index) {
        return this.elementList[index]
      },
      removeElement: function(element,event) {
        var index = _.findIndex(this.elementList, { uid: element.uid });
        this.elementList.splice(index, 1)
        this.editElementShow = false

      },
      editElement: function(element,event) {
        var index = _.findIndex(this.elementList, { uid: element.uid });
        this.selectedElement = element
        this.editElementShow = true
      },
      saveForm: function() {
        let that = this
        var ajaxData = { action: 'swd_save_form', data: this.elementList, post_id: false};
        axios.post('/wp-admin/admin-ajax.php', Qs.stringify(ajaxData))
        .then(function (response) {
          console.log(response)
        })
        .catch(function (error) {
          console.log(error);
        });

        this.elementList = [];
        this.editElementShow = false
      },
      randomId: function() {
        return '_' + Math.random().toString(36).substr(2, 9);
      },
      doneEdit: function() {
        this.editElementShow = false
      },
      getElementContent: function(element) {
        var html = '<'+element.tag+' style="width: '+element.styles.width+element.styles.width_type+'; margin: '+element.styles.margin.top+'px '+element.styles.margin.right+'px '+element.styles.margin.bottom+'px '+element.styles.margin.left+'px ;padding: '+element.styles.padding.top+'px '+element.styles.padding.right+'px '+element.styles.padding.bottom+'px '+element.styles.padding.left+'px;" type="'+element.type+'"  class="swd-input" placeholder="'+element.placeholder+'" ></'+element.tag+'>'
        return html;
      },
    },
    components: {
      Container,
      Draggable,
    }
}





//<div class="form-group">
//  <label for="element-width-select">{{selectedElement.name}} Width (%):</label>
//  <select v-model="selectedElement.styles.width" class="form-control" id="element-width-select">
//    <option>100</option>
//    <option>75</option>
//    <option>50</option>
//    <option>25</option>
//  </select>
//</div>
//<h4>Padding</h4>
//<div class="input-group mb-3">
//  <div class="input-group-prepend">
//    <label class="input-group-text" for="padding-top">Top</label>
//  </div>
//  <input style="height:100%;" v-model="selectedElement.styles.padding.top" type="number" class="form-control" aria-label="padding-top" aria-describedby="padding-top">
//  <div class="input-group-prepend">
//    <label class="input-group-text" for="padding-right">Right</label>
//  </div>
//  <input style="height:100%;" v-model="selectedElement.styles.padding.right" type="number" class="form-control" aria-label="padding-right" aria-describedby="padding-right">
//  <div class="input-group-prepend">
//    <label class="input-group-text" for="padding-bottom">Bottom</label>
//  </div>
//  <input style="height:100%;" v-model="selectedElement.styles.padding.bottom" type="number" class="form-control" aria-label="padding-bottom" aria-describedby="padding-bottom">
//  <div class="input-group-prepend">
//    <label class="input-group-text" for="padding-right">Left</label>
//  </div>
//  <input style="height:100%;" v-model="selectedElement.styles.padding.left" type="number" class="form-control" aria-label="padding-left" aria-describedby="padding-left">
//</div>
//<h4>Margin</h4>
//<div class="input-group mb-3">
//  <div class="input-group-prepend">
//    <label class="input-group-text" for="margin-top">Top</label>
//  </div>
//  <input style="height:100%;" v-model="selectedElement.styles.margin.top" type="number" class="form-control" aria-label="margin-top" aria-describedby="margin-top">
//  <div class="input-group-prepend">
//    <label class="input-group-text" for="margin-right">Right</label>
//  </div>
//  <input style="height:100%;" v-model="selectedElement.styles.margin.right" type="number" class="form-control" aria-label="margin-right" aria-describedby="margin-right">
//  <div class="input-group-prepend">
//    <label class="input-group-text" for="margin-bottom">Bottom</label>
//  </div>
//  <input style="height:100%;" v-model="selectedElement.styles.margin.bottom" type="number" class="form-control" aria-label="margin-bottom" aria-describedby="margin-bottom">
//  <div class="input-group-prepend">
//    <label class="input-group-text" for="margin-right">Left</label>
//  </div>
//  <input style="height:100%;" v-model="selectedElement.styles.margin.left" type="number" class="form-control" aria-label="margin-left" aria-describedby="margin-left">
//</div>
//<h4>Placholder Text</h4>
//<div class="form-group">
//  <input type="text" class="form-control" v-model="selectedElement.placeholder" />
//</div>
//<h4>Input Alignment</h4>
//<div class="form-group">
//  <select v-model="selectedElement.styles.justify" class="form-control" id="element-width-select">
//    <option value="flex-start" >Left</option>
//    <option value="center" >Center</option>
//    <option value="flex-end" >Right</option>
//  </select>
//</div>
</script>
<style>

</style>
