<template>
<div>
    <div class="row">
      <div class="col-12">
        <label>Padding</label>
      </div>
    </div>
    <div class="row">
      <div class="col-3 no-padding">
        <label class="label-help-text" for="padding-top">Top</label>
        <input v-model="element.styles.padding.top" type="number" class="form-control" id="padding-top">
      </div>
      <div class="col-3 no-padding">
        <label class="label-help-text" for="padding-right">Right</label>
        <input v-model="element.styles.padding.right" type="number" class="form-control" id="padding-right">
      </div>
      <div class="col-3 no-padding">
        <label class="label-help-text" for="padding-bottom">Bottom</label>
        <input v-model="element.styles.padding.top" type="number" class="form-control" id="padding-bottom">
      </div>
      <div class="col-3 no-padding">
        <label class="label-help-text" for="padding-left">Left</label>
        <input v-model="element.styles.padding.left" type="number" class="form-control" id="padding-left">
      </div>
    </div>
</div>
</template>


<script>

export default {
    data () {
      return {}
    },
    props: ['element'],
    components: {
    }
}
</script>
