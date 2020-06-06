<template>
  <div id="vue-backend-app">
    <div class="px-8 pb-10">
      <main class="flex">
        <aside class="w-64 pt-8">
          <section class="mb-10">
            <h5 class="uppercase font-bold mb-5 text-base">Amar Kaaz</h5>
            <ul class="list-reset">
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/" exact>Home</router-link>
              </li>
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/logo-symbol">Today</router-link>
              </li>
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/colors">Previous</router-link>
              </li>
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/typography">Upcoming</router-link>
              </li>
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/typography">Repeat</router-link>
              </li>
            </ul>
          </section>
          <section class="mb-10">
            <h5 class="uppercase font-bold mb-5 text-base">Progress</h5>
            <ul class="list-reset">
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/mascot">Calender Graph</router-link>
              </li>
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/illustration">Insight</router-link>
              </li>
            </ul>
          </section>
          <section>
            <h5 class="uppercase font-bold mb-5 text-base">Settings</h5>
            <ul class="list-reset">
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/site-stats">Kaaz Category</router-link>
              </li>
              <li class="text-sm leading-loose">
                <router-link class="text-black" to="/achievements">Notifications</router-link>
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

<style></style>
