<template>
<div>
  <div class="row mt-5">
    <div class="col">
      <h2>{{formTitle}}</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-12 col-lg-8">
      <Container class="list-item-container" :group-name="'1'" :get-child-payload="getChildPayload2" @drop="onDrop('elementList', $event)">
        <Draggable :data-delete="element.uid" v-for="element in elementList" :key="element.uid">
          <div class="the-element">
            <div class="element-actions">
              <div v-if="element.uid != 'SUBMITBUTTON'" @click="removeElement(element, $event)" class="delete clickable"><i class="fas fa-times"></i></div>
              <div  @click="editElement(element, $event)" class="edit clickable"><i class="fas fa-ellipsis-h"></i></div>
            </div>
            <div class="form-element draggable-item">
              <div class="element-inner">
                  <div class="swd-form-element-wrapper" :style="{'justify-content': element.styles.justify}" v-html="getElementContent(element)"></div>
              </div>
            </div>
          </div>
        </Draggable>
      </Container>
    </div>
    <div v-if="editElementShow" class="col-12 col-lg-4">
      <template v-for="control in selectedElement.controls">
          <component :is="control"  :element="selectedElement"></component>
      </template>
      <div class="form-group">
        <button @click="doneEdit()" type="button" class="btn btn-dark">Update</button>
      </div>
    </div>
    <div v-else class="col-4">
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
    <div class="col-12">
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
import PaddingControl     from './controls/Padding.vue'
import MarginControl      from './controls/Margin.vue'
import WidthControl       from './controls/Width.vue'
import JustifyControl     from './controls/Justify.vue'
import PlaceholderControl from './controls/Placeholder.vue'
import ColorControl from './controls/Color.vue'
//import BackgroundControl from './controls/Background.vue'

export default {
    data () {
      return {
        widgetList: formBuilderData.form_widgets,
        elementList: [
          {
            id: 'submit-button',
            uid: 'SUBMITBUTTON',
            placeholder: 'Submit',
            tag: 'input',
            type: 'submit',
            styles: {
              width: 100,
              color: {
                rgba:{
                  a: 1,
                  b: 0,
                  g: 0,
                  r: 0,
                }
              },
              width_type: '%',
              margin: {
                  top: 0,
                  right: 0,
                  bottom: 0,
                  left: 0,
              },
              padding: {
                  top: 8,
                  right: 8,
                  bottom: 8,
                  left: 8,
              },
              justify: 'center',
            },
            controls: [
              'WidthControl',
              'PaddingControl',
              'MarginControl',
              'JustifyControl',
              'PlaceholderControl',
              'ColorControl',
              //'BackgroundControl',
            ]
          }
        ],
        formTitle: 'New Form',
        editElementShow: false,
        selectedElement: {
          name: 'test',
          width: 100,
          controls: [
            'WidthControl'
          ],
          uid: 'asdfasdf'
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
        var html = '<'+element.tag+' style="color: rgba('+element.styles.color.rgba.r+','+element.styles.color.rgba.b+','+element.styles.color.rgba.g+','+element.styles.color.rgba.a+');width: '+element.styles.width+element.styles.width_type+'; margin: '+element.styles.margin.top+'px '+element.styles.margin.right+'px '+element.styles.margin.bottom+'px '+element.styles.margin.left+'px ;padding: '+element.styles.padding.top+'px '+element.styles.padding.right+'px '+element.styles.padding.bottom+'px '+element.styles.padding.left+'px;" type="'+element.type+'"  class="swd-input" placeholder="'+element.placeholder+'" ></'+element.tag+'>'
        return html;
      },
    },
    components: {
      Container,
      Draggable,
      PaddingControl,
      MarginControl,
      WidthControl,
      JustifyControl,
      PlaceholderControl,
      ColorControl,
      //BackgroundControl,
    }
}
</script>
<style>

</style>
