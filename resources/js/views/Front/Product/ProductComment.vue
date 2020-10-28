<template>
  <div class="container-fluid pl-3 pt-1">
    <div class="d-flex justify-content-between">
      <div class="">
        <img :src="comment.user.profile_src" width="60" alt="" />
        <span class="d-name"
          ><strong>{{ comment.user.name }}</strong></span
        >
      </div>
      <div class="my-auto">
        <i class="fa fa-reply px-2 cursor" @click="showTextArea"></i>
        <i
          class="fa fa-trash text-danger px-2 cursor"
          @click="deleteComment"
          v-if="CanUserDelete"
        ></i>
      </div>
    </div>
    <div>
      <p class="userComment">
        {{ comment.body }}
      </p>
    </div>

    <!--  reply comment  -->
    <div v-if="isReply">
      <div class="form-group mt-5 col-md-6">
        <label for="comment">
          <h4>
            <strong> ثبت نظر: </strong>
          </h4>
        </label>
        <textarea
          name="comment"
          id="comment"
          placeholder="نظر خود را بنویسید..."
          class="form-control p-2"
          v-model="replyComment.body"
          cols="15"
          rows="7"
        ></textarea>
        <base-btn
          class="comment-btn mt-2"
          v-if="replyComment.body"
          :loading="replyComment.busy"
          @click="submitReplyComment"
          >ثبت</base-btn
        >
      </div>
    </div>
    <!--  reply comment  -->

    <product-comment
      v-for="replyComment in comment.reply_comments"
      :key="replyComment.id"
      :comment="replyComment"
      @delete-comment="hideComment"
    ></product-comment>
  </div>
</template>

<script>
import { Form } from "vform";
import ProductComment from "@/views/Front/Product/ProductComment.vue";
import { mapGetters } from "vuex";
export default {
  name: "ProductComment",
  props: {
    comment: {
      type: [Object, Array],
      required: true,
    },
  },
  data() {
    return {
      isReply: false,
      replyComment: new Form({
        body: null,
        product_id: null,
        comment_id: null,
      }),
    };
  },
  computed: {
    CanUserDelete() {
      return this.comment.user_id === this.user.id || this.user.is_admin === 1;
    },

    ...mapGetters("auth", ["user"]),
  },

  methods: {
    showTextArea() {
      this.isReply = !this.isReply;
      this.replyComment = new Form({
        body: null,
        comment_id: this.comment.id,
        product_id: this.comment.product_id,
      });
    },
    submitReplyComment() {
      this.replyComment
        .post(`/api/comment`)
        .then(({ data }) => {
          swal.message("پس از تایید ادمین ثبت میشود", "info", 3000);
          this.replyComment = null;
          this.isReply = !this.isReply;
        })
        .catch((e) => {
          swal.message("نظر شما ارسال نشد", "error");
        });
    },
    deleteComment() {
      this.$emit("delete-comment", this.comment);
      axios.delete(`/api/comment/${this.comment.id}`);
    },
    hideComment(comment) {
      let index = this.comment.reply_comments.indexOf(comment);
      this.comment.reply_comments.splice(index, 1);
    },
  },
};
</script>

<style scoped>
.userComment {
  overflow: auto;
}
.cursor {
  cursor: pointer;
}
.d-name {
  overflow: hidden;
}
</style>