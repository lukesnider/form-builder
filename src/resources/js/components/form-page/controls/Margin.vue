<template>
<div>
  <div class="row">
    <div class="col-12">
      <label>Margin</label>
    </div>
  </div>
  <div class="row">
    <div class="col-3 no-padding">
      <label class="label-help-text" for="margin-top">Top</label>
      <input v-model="element.styles.margin.top" type="number" class="form-control" id="margin-top">
    </div>
    <div class="col-3 no-padding">
      <label class="label-help-text" for="margin-right">Right</label>
      <input v-model="element.styles.margin.right" type="number" class="form-control" id="margin-right">
    </div>
    <div class="col-3 no-padding">
      <label class="label-help-text" for="margin-bottom">Bottom</label>
      <input v-model="element.styles.margin.bottom" type="number" class="form-control" id="margin-bottom">
    </div>
    <div class="col-3 no-padding">
      <label class="label-help-text" for="margin-left">Left</label>
      <input v-model="element.styles.margin.left" type="number" class="form-control" id="margin-left">
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
