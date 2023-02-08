<template>
  <div>
<!--      <button type="button" class="btn btn-primary" @click="showModal">Primary</button>-->
      <b-button v-b-modal.subscriberPopup>Launch demo modal</b-button>
      <SubscriberPopup />
  </div>
</template>

<script>
import SubscriberPopup from "./SubscriberPopup.vue";

export default {
    components: {
        SubscriberPopup,
    },
    methods: {
        showModal:(e) => {
            // $(e.target).on('shown.bs.modal', function () {
            //     $('#myInput').trigger('focus')
            // })
        }
    }
};

</script>