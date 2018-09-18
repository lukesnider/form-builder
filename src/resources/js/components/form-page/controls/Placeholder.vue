<template>
<div>
    <div class="row">
      <div class="form-group">
        <label>Placeholder Text</label>
        <input type="text" class="form-control" v-model="element.placeholder" />
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
