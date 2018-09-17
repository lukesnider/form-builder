<template>
<div>
  <div class="row mt-5">
    <div class="col">
      <h2>{{formTitle}}</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-9">
      <Container class="list-item-container" :group-name="'1'" :get-child-payload="getChildPayload2" @drop="onDrop('elementList', $event)">
        <Draggable :data-delete="element.uid" v-for="element in elementList" :key="element.uid">
          <div class="element-actions">
            <div @click="removeElement(element, $event)" class="delete clickable"><i class="fas fa-times"></i></div>
            <div  @click="editElement(element, $event)" class="edit clickable"><i class="fas fa-ellipsis-h"></i></div>
          </div>
          <div class="form-element draggable-item">
            <div class="element-inner">
              <div class="form-group" :style="{width: element.width + element.widthType}">
                <span v-html="element.content"></span>
              </div>
            </div>
          </div>
        </Draggable>
      </Container>
    </div>
    <div v-if="editElementShow" class="col-3">
      <div class="form-group">
        <label for="element-width-select">{{selectedElement.name}} Width (%):</label>
        <select v-model="selectedElement.width" class="form-control" id="element-width-select">
          <option>100</option>
          <option>75</option>
          <option>50</option>
          <option>25</option>
        </select>
      </div>
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

export default {
    data () {
      return {
        widgetList: [
          {
            id: 1,
            name: 'Text',
            icon: 'fas fa-font',
            tag: 'input',
            type: 'text',
            uid: false,
            content: '<input type="text"  class="form-control" placeholder="Text Input..." />',
            width: 100,
            widthType:'%',
          },
          {
            id: 2,
            name: 'Email',
            icon: 'far fa-envelope',
            tag: 'input',
            type: 'email',
            uid: false,
            content: '<input type="email" class="form-control" placeholder="Enter email">',
            width: 100,
            widthType:'%',
          },
          {
            id: 3,
            name: 'Multiline Text',
            icon: 'far fa-comment-alt',
            tag: 'textarea',
            type: '',
            uid: false,
            content: '<textarea class="form-control" rows="3">Text Area Input...</textarea>',
            width: 100,
            widthType:'%',
          },
        ],
        elementList: [
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
        console.log(this.elementList);
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
    },
    components: {
      Container,
      Draggable,
    }
}
</script>
<style scoped>
.draggable-item {
  cursor: move;
}
.smooth-dnd-container {
  min-width: 100px;
  min-height: 100px;
  transition: all .5s;
}
.form-widget {
  padding: 10px;
  border: solid 1px rgba(0,0,0,0.85);
  width: 100%;
}
.form-element {
}
.smooth-dnd-draggable-wrapper:hover .form-element {
  border: solid 1px #C4D6B0;
}
.element-inner {
  display:flex;
  flex-direction: row;
  justify-content: space-between;
}
.clickable.remove-element-button {
  color: #F71735;
}
div.clickable{
  cursor: pointer;
}
.smooth-dnd-container.vertical > .smooth-dnd-draggable-wrapper {
    overflow: visible;
}
.element-actions {
    justify-content: center;
    align-items: center;
    z-index: 999;
    background: #C4D6B0;
    width: 75px;
    display: none;
}
.smooth-dnd-draggable-wrapper:hover .element-actions {
  display:flex;
}
.element-actions svg {
  color: #291F1E;
}
.element-actions .clickable {
  padding: 5px;
}
</style>
