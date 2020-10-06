<template>
  <div>
    <input class="my-3" 
    :class="{'is_invalid' : $parent[form].errors.has(fieldName), classes}"
     type="file" v-bind="$attrs" @change="UploadProfile" />
    <img :src="profile_image" width="120" />
    <has-error :form="$parent['form']" :field="fieldName"></has-error>
  </div>
</template>

<script>
import { HasError } from "vform";
export default {
  inheritAttrs: false,
  name: "BasePhotoInput",
  components: {
    HasError,
  },
  props: {
    value: {
      type: String,
      default: null,
    },
    classes: {
      type: String,
      default: null,
    },
    form: {
      type: String,
      default: "form",
    },
    field: {
      type: String,
      default: null,
    },
    name: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      file: null,
    };
  },
  computed: {
    profile_image() {
        let value = this.value;
        if(! value){
            value = '/profile/avatar.png'
        }
      return this.file ? this.file : value;
    },
    fieldName() {
      return this.field ? this.field : this.name;
    },
  },
  methods: {
    UploadProfile(event) {
      let file = event.target.files[0];
      this.$emit('src', file.name)
      let reader = new FileReader();
      reader.onload = () => {
        this.file = reader.result;
        this.$emit("input", reader.result);
      };
      reader.readAsDataURL(file);
    },
  },
};
</script>

<style>
</style>