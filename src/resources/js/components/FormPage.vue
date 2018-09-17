<template>
<div>
  <div class="container-fluid">
    <div class="row mt-5">
      <div class="col">
          <h2>Form Builder</h2>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col">
        <navigation></navigation>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="forms" role="tabpanel" aria-labelledby="forms-tab">
            Forms
          </div>
          <div class="tab-pane fade show" id="builder" role="tabpanel" aria-labelledby="builder-tab">
            <form-builder></form-builder>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>


<script>
import FormBuilder from './form-page/FormBuilder.vue'
import Navigation from './form-page/Navigation.vue'


export default {
    data () {
      return {}
    },
    components: {
      'form-builder': FormBuilder,
      'navigation': Navigation,
    }
}
</script>
