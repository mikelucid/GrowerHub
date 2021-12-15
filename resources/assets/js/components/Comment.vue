<template>

  <div class="commented-section mt-2">
    <div class="d-flex flex-row align-items-center commented-user">
      <h5 class="mr-2">{{username}}</h5>
      <span class="dot mb-1"></span>
      <span class="mb-1 ml-2">5 hours ago</span>
    </div>
    <div class="comment-text-sm truncate">
      <span>{{body}}</span>
    </div>
    <div class="reply-section">
      <div class="d-flex flex-row align-items-center voting-icons">
        <i class="fa fa-sort-up fa-2x mt-3 hit-voting"></i>
        <i class="fa fa-sort-down fa-2x mb-3 hit-voting"></i>
        <span class="ml-2">15</span>
        <span class="dot ml-2"></span>
        <h6 class="ml-2 mt-1">Reply</h6>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  props: ["comment"],

  data() {
    return {
      body: this.comment.body,
      username: this.comment.user.name,
      created_at: this.comment.created_at,
      id: this.comment.id,
      comment: this.comment,
    }
  }
}
</script>