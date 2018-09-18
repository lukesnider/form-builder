<template>
<div>
    <div class="row">
      <div class="form-group">
        <label>Color</label>
        <chrome-picker  v-model="element.styles.color"></chrome-picker>
      </div>
    </div>
</div>
</template>


<script>
import slider from   '../../../../../../node_modules/vue-color/src/components/Slider.vue'
import photoshop from   '../../../../../../node_modules/vue-color/src/components/Photoshop.vue'
import chrome from   '../../../../../../node_modules/vue-color/src/components/Chrome.vue'

export default {
    data () {
      return {}
    },
    props: ['element'],
    components: {
      'slider-picker': slider,
      'photoshop-picker': photoshop,
      'chrome-picker': chrome,

    },
    mounted: function() {

    }
}
</script>
