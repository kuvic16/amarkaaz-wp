<template>
  <div id="vue-backend-app">
    <div class="px-8">
      <main class="flex">
        <aside class="w-160 pt-8">
          <section class="mb-10">
            <h5 class="uppercase font-bold mb-5 text-base">Amar Kaaz</h5>
            <ul class="list-reset">
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/" exact>Home</router-link>
              </li>
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/today-kaaz">Today</router-link>
              </li>
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/previous-kaaz">Previous</router-link>
              </li>
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/upcoming-kaaz">Upcoming</router-link>
              </li>
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/repeat-kaaz">Repeat</router-link>
              </li>
            </ul>
          </section>
          <section class="mb-10">
            <h5 class="uppercase font-bold mb-5 text-base">Progress</h5>
            <ul class="list-reset">
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/calender-graph">Calender Graph</router-link>
              </li>
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/insight">Insight</router-link>
              </li>
            </ul>
          </section>
          <section>
            <h5 class="uppercase font-bold mb-5 text-base">Settings</h5>
            <ul class="list-reset">
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/kaaz-category">Kaaz Category</router-link>
              </li>
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/notifications">Notifications</router-link>
              </li>
            </ul>
          </section>
        </aside>
        <div class="primary flex-1 pt-8">
          <div>
            <span class="float-right">A new way to manage personal task aiming to keep focusing</span>
          </div>
          <router-view class="mt-10"></router-view>
        </div>
      </main>
    </div>
  </div>
</template>

<script>
export default {
  name: "App"
};
</script>

<style>
.w-160 {
  width: 160px;
}
</style>
