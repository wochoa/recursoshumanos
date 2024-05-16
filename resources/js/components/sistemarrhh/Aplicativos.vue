<script>
/**
 * Stat component -- specify the widget icon, title and value.
 */
export default {
  props: {
    title: {
      type: String,
      default: ""
    },
    value: {
      type: String,
      default: ""
    },
    icon: {
      type: String,
      default: ""
    },
    url: {
      type: String,
      default: ""
    },
    borde: {
      type: String,
      default: ""
    },
  },
  methods:{
    accesoaplicativo()
    {
        alert('hola');
    }
  }
};
</script>

<template>
  <div :class="'card mini-stats-wid bg-'+borde" @click="accesoaplicativo" style="cursor:pointer">
    <div class="card-body">
      <div class="d-flex">
        <div class="flex-grow-1">
          <p class="text-muted fw-medium">{{title}}</p>
          <h6 class="mb-0">{{value}}</h6>
        </div>

        <div class="mini-stat-icon avatar-sm align-self-center rounded-circle bg-primary">
          <span class="avatar-title">
            <i :class="`${icon} font-size-24`"></i>
          </span>
        </div>
      </div>
    </div>
    <!-- end card-body -->
  </div>
  <!-- end card -->
</template>
