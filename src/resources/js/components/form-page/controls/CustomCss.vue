<template>
<div>
    <div class="row">
      <div class="form-group">
        <label>Custom Css</label>
        <textarea v-model="styles" rows="4" style="width:100%;" ></textarea>
      </div>
    </div>
</div>
</template>


<script>

export default {
    data () {
      return {
      }
    },
    props: ['styles'],
    components: {
    },
    mounted: function() {

    }
}
</script>
