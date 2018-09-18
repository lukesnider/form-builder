<template>
<div>
    <div class="row">
      <div class="form-group">
        <label>Background</label>
        <chrome-picker  v-model="element.styles.background"></chrome-picker>
      </div>
    </div>
</div>
</template>


<script>
import chrome from   '../../../../../../node_modules/vue-color/src/components/Chrome.vue'

export default {
    data () {
      return {}
    },
    props: ['element'],
    components: {
      'chrome-picker': chrome,

    },
    mounted: function() {

    }
}
</script>
