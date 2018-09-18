<template>
<div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="element-width-select">{{element.name}} Width (%):</label>
          <select v-model="element.styles.width" class="form-control" id="element-width-select">
            <option>100</option>
            <option>75</option>
            <option>50</option>
            <option>25</option>
          </select>
        </div>
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
    props: ['element'],
    components: {
    }
}
</script>
