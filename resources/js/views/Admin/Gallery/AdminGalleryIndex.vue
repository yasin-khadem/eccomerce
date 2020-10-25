<template>
  <div class="container">
    <header class="my-3">
      <div class="d-flex justify-content-between">
        <h5>گالری عکس ها</h5>
        <router-link
          class="btn btn-create-gallery text-white"
          :to="{ name: 'admin-gallery', params: { url: 'create' } }"
        >
          <i class="far fa-images"></i>
          ایجاد عکس گالری
        </router-link>
      </div>
    </header>

    <div class="mt-1 mb-2">
      <h4>جست و جو</h4>
      <div class="col-md-6 d-flex flex-row mb-3 search-input">
        <base-input name="search" placeholder="جست و جو کد محصول" v-model="form.search"></base-input>
        <base-btn :loading="searchLoading" @click="searchImage" class="ml-2 mb-2">
          <i class="fa fa-search"></i>
        </base-btn>
      </div>
      <div class="mt-3 flex flex-row" v-if="refreshShowAll">
        <label class="my-1 mr-2">
          <h5><strong>نمایش همه</strong></h5>
        </label>
        <base-btn
          class="ml-2 mb-2 search-btn"
          :loading="refresh"
          @click="refreshGallery"
        >
          <i class="fas fa-sync"></i>
        </base-btn>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th class="align-middle text-center" scope="col">عکس</th>
            <th class="text-center" scope="col"># محصول</th>
            <th class="text-center" scope="col">کد محصول</th>
            <th class="text-center" scope="col" colspan="2">حذف</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(image, index) in images.data" :key="image.id">
            <td class="align-middle">{{ image.id }}</td>
            <td class="text-center">
              <img :src="'/' + image.gallery_src" width="100" />
            </td>
            <td class="text-center align-middle">
              {{ image.product_id }}
            </td>
            <td class="text-center align-middle">
              {{ image.product_code }}
            </td>
            <td class="text-center align-middle">
              <button
                class="btn btn-danger"
                @click="deleteGalleryItem(image.id, index)"
              >
                حذف
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <pagination
        :data="images"
        @pagination-change-page="getImages"
        :limit="1"
      ></pagination>
    </div>
  </div>
</template>

<script>
import { Form } from "vform";
export default {
  name: "AdminGalleryIndex",
  metaInfo: {
    title: "عکس های گالری",
  },
  components: {
    Form,
  },
  data() {
    return {
      images: {},
      refresh: false,
      searchLoading: false,
      form: new Form({
        search: null,
      }),
    };
  },

  computed: {
    refreshShowAll() {
      if (this.form.search || this.$route.query.search) {
        return true;
      }
    },
  },
  created() {
    this.form.search = this.$route.query.search;
    this.getImages(this.$route.query.page);
  },
  methods: {
    searchImage() {
      let queries = this.$route.query;
      queries.search = this.form.search;
      this.searchLoading = true;
      this.getImages().finally(() => {
        this.searchLoading = false;
      });
    },
    refreshGallery() {
      this.form.search = null;
      this.$route.query.search = null;
      this.refresh = true;
      this.getImages().finally(() => {
        this.refresh = false;
      });
    },
  
    getImages(page = 1) {
      let queries = this.$route.query;
      queries.page = page;
      return axios
        .get(`/api/admin/image`, {
          params: queries,
        })
        .then(({ data }) => {
          this.images = data;
          window.history.replaceState(
            "images",
            "Images",
            `/admin/gallery/index?${data.meta.queries}`
          );
        });
    },
      deleteGalleryItem(id, index) {
      swal.confirm().then((result) => {
        if (result.value) {
          return axios.delete(`/api/admin/image/${id}`).then(({ data }) => {
            this.images.data.splice(index, 1);
          });
        }
      });
    },
  },
};
</script>

<style scoped>
.btn-create-gallery {
  background-color: #43a047;
}
</style>