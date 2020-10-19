<template>
  <div class="container">
    <header class="my-3">
      <div class="d-flex justify-content-center">
        <div class="card">
          <h5>لیست نظر ها</h5>
        </div>
      </div>
    </header>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th class="text-center" scope="col">#</th>
            <th class="text-center" scope="col">نام کاربر</th>
            <th class="text-center" scope="col"># محصول</th>
            <th class="text-center" scope="col">نام محصول</th>
            <th
              class="text-center table-comment-padding table-heading-padding"
              scope="col"
            >
              نظر
            </th>
            <th class="text-center" scope="col" colspan="2">عملیات</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(comment, index) in comments.data" :key="comment.id">
            <td class="text-center">{{ comment.id }}</td>
            <td class="text-center">{{ comment.user.name }}</td>
            <td class="text-center">{{ comment.product.id }}</td>
            <td class="text-center">{{ comment.product.name }}</td>
            <td class="text-center table-comment-padding">
              {{ comment.body }}
            </td>
            <td class="text-center">
              <div class="d-flex justify-content-around">
                <a
                  class="btn btn-sm btn-primary text-white"
                  @click="confirmComment(comment.id, index)"
                  >تایید</a
                >
                <a
                  class="btn btn-sm btn-danger"
                  @click="deleteComment(comment.id, index)"
                  ><i class="fa fa-trash"></i
                ></a>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <pagination
        :data="comments"
        @pagination-change-page="getComments"
        :limit="1"
      ></pagination>
    </div>
  </div>
</template>

<script>
export default {
  name: "AdminCommentIndex",
  metaInfo: {
    title: "لیست نظر ها",
  },
  data() {
    return {
      comments: {},
    };
  },
  created() {
    this.getComments(this.$route.query.page);
  },
  methods: {
    getComments(page = 1) {
      axios.get(`/api/admin/comment?page=${page}`).then(({ data }) => {
        this.comments = data;
        window.history.replaceState(
          "comments",
          "Comments",
          `/admin/comment/index?page=${page}`
        );
      });
    },
    confirmComment(id, index) {
      swal.confirm("آیا مطمین هستید", "warning").then((result) => {
        if (result.value) {
          axios
            .patch(`/api/admin/comment/${id}`, { is_confirmed: 1 })
            .then(() => {
              this.comments.data.splice(index, 1);
            });
        }
      });
    },
    deleteComment(id, index) {
      swal.confirm("آیا مطمین هستید", "warning").then((result) => {
        if (result.value) {
          axios
            .delete(`/api/admin/comment/${id}`)
            .then(() => {
              this.comments.data.splice(index, 1);
            });
        }
      });
    },
  },
};
</script>

<style scoped>
.card {
  background-color: #9c27b0;
  padding: 0.35rem 0.75rem 0.15rem 0.75rem;
  color: #fff;
}
.table-heading-padding {
  padding-right: 3.5rem;
  padding-left: 3.5rem;
}
.table-comment-padding {
  max-width: 100px;
  overflow: auto;
}
</style>