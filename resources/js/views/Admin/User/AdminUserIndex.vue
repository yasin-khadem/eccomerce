<template>
  <div class="container">
    <header class="my-3">
      <div class="d-flex justify-content-between">
        <h5>لیست کاربران</h5>
        <router-link
          class="btn btn-create-user text-white"
          :to="{ name: 'admin-user', params: { url: 'create' } }"
        >
          <i class="fa fa-user-plus"></i>
          ایجاد کاربر جدید
        </router-link>
      </div>

      <div class="mt-3">
        <h4>جست و جو</h4>
        <div class="col-md-6 d-flex flex-row mb-3 search-input">
          <base-input
            name="search"
            placeholder="ایمیل یا نام کاربر"
            v-model="form.search"
          ></base-input>
          <base-btn @click="searchUser" class="ml-2 mb-2">
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
            @click="refreshUsers"
          >
            <i class="fas fa-sync"></i>
          </base-btn>
        </div>
      </div>
    </header>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">نام</th>
            <th scope="col">ایمیل</th>
            <th scope="col">نوع کاربر</th>
            <th scope="col">تاریخ ساخت حساب</th>
            <th scope="col" colspan="2">تغییرات</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(user, index) in users.data" :key="user.id">
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.type }}</td>
            <td>{{ moment(user.created_at).format("jYY/jM/jD") }}</td>
            <td>
              <router-link
                :to="{
                  name: 'admin-user-edit',
                  params: { url: 'edit', id: user.id },
                }"
                class="btn btn-info"
                >ویرایش</router-link
              >
            </td>
            <td>
              <button
                class="btn btn-danger"
                @click="deleteUser(user.id, index)"
              >
                حذف
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <pagination
        :data="users"
        @pagination-change-page="getUser"
        :limit="1"
      ></pagination>
    </div>
  </div>
</template>

<script>
import { Form } from "vform";
import moment from "moment-jalaali";
export default {
  name: "AdminUserIndex",
  metaInfo: {
    title: "لیست کاربران",
  },
  components: {
    Form,
  },
  data() {
    return {
      refresh: false,
      searchLoading: false,
      form: new Form({
        search: null,
      }),
      users: {},
      moment,
    };
  },
  created() {
    this.getUser(this.$route.query.page);
  },
  computed: {
    refreshShowAll() {
      if (this.form.search || this.$route.query.search) {
        return true;
      }
    },
  },
  methods: {
    getUser(page = 1) {
      let queries = this.$route.query;
      queries.page = page;
      // axios.get(`/api/admin/users?page=${page}`).then(({ data }) => {
      return  axios.get(`/api/admin/users`,{params: queries})
      .then(({ data }) => {
        this.users = data;
        window.history.replaceState(
          "users",
          "Users",
          // `/admin/user/index?page=${page}`
          `/admin/user/index?${data.meta.queries}`
        );
      });
    },
    deleteUser(id, index) {
      swal.confirm().then((result) => {
        if (result.value) {
          axios.delete(`/api/admin/users/${id}`).then(({ data }) => {
            this.users.data.splice(index, 1);
          });
        }
      });
    },
    searchUser() {
      let queries = this.$route.query;
      queries.search = this.form.search;
      this.searchLoading = true;
      this.getUser().finally(() => {
        this.searchLoading = false;
      });
    },
    refreshUsers() {
      this.form.search = null;
      this.$route.query.search = null;
      this.refresh = true;
      this.getUser().finally(() => {
        this.refresh = false;
      });
    },
  },
};
</script>

<style scoped>
.btn-create-user {
  background-color: #43a047;
}
</style>