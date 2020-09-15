<template>
  <div class="container">
    <header class="my-3">
      <div class="d-flex justify-content-between">
        <h5>لیست کاربران</h5>
        <router-link
          class="btn btn-create-user text-white"
          :to="{name: 'admin-user' , params:{url:'create'}}"
        >
          <i class="fa fa-user-plus"></i>
          ایجاد کاربر جدید
        </router-link>
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
          <tr v-for="(user,index) in users.data" :key="user.id">
            <td>{{user.id}}</td>
            <td>{{user.name}}</td>
            <td>{{user.email}}</td>
            <td>{{user.type}}</td>
            <td>{{user.created_at}}</td>
            <td>
              <router-link
                :to="{name:'admin-user-edit',params:{url:'edit',id:user.id}}"
                class="btn btn-info"
              >ویرایش</router-link>
            </td>
            <td>
              <button class="btn btn-danger" @click="deleteUser(user.id,index)">حذف</button>
            </td>
          </tr>
        </tbody>
      </table>
      <pagination :data="users" @pagination-change-page="getUser"></pagination>
    </div>
  </div>
</template>

<script>
export default {
  name: "AdminUserIndex",
  metaInfo: {
    title: "لیست کاربران",
  },
  data() {
    return {
      users: {},
    };
  },
  created() {
    this.getUser(this.$route.query.page);
  },
  methods: {
    getUser(page = 1) {
      axios.get(`/api/admin/users?page=${page}`).then(({ data }) => {
        this.users = data;
        window.history.pushState(
          "users",
          "Users",
          `/admin/user/index?page=${page}`
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
  },
};
</script>

<style scoped>
.btn-create-user {
  background-color: #43a047;
}
</style>