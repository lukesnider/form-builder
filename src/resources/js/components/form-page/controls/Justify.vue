<template>
<div>
    <div class="row">
      <div class="form-group">
        <label>Alignment</label>
        <select v-model="element.styles.justify" class="form-control" id="element-width-select">
          <option value="flex-start" >Left</option>
          <option value="center" >Center</option>
          <option value="flex-end" >Right</option>
        </select>
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
