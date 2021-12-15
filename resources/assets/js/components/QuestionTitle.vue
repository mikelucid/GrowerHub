<template>
  <div class="d-flex flex-row align-items-center text-left comment-top p-2 bg-white border-bottom px-4">
    <div class="profile-image">
      <vote :model="this.model" name="question"></vote>
    </div>
    <div class="d-flex align-items-center">
      <div class="d-flex flex-grow-0 flex-column ml-3">
        <div class="d-flex flex-row post-title">
          <h3>{{ this.model.title }}</h3>
        </div>
        <div class="d-flex flex-grow-1 flex-row align-items-center align-content-center post-title">
          <span class="btn btn-sm btn-outline-secondary mr-1" :v-for="name in tags">{{ name }}</span>
          <span class="mr-2 comments">13 comments&nbsp;</span>
          <span class="mr-2 dot"></span>
          <span>{{ postDate }}</span>
        </div>
      </div>
      <div class="ml-auto d-flex flex-grow-0">
        <a href="/questions" class="btn btn-outline-secondary">Back to all Questions</a>
      </div>
    </div>
  </div>
</template>

<script>
import Vote from './Vote.vue';
import UserInfo from "./UserInfo";

export default {
  props: ['model', 'label'],
  components: {Vote},

  computed: {
    postDate() {
      return this.label + " " + this.model.created_date;
    }
  },

  data() {
    return {
      tags: this.model.tags,
      user: this.model.user
    }
  }
}
</script>
