<template>
  <div id="app">
    <h1>LINFORD</h1>
    <AddEntityScreen />
  </div>
</template>

<script>
import AddEntityScreen from "./screens/AddEntityScreen";

export default {
  name: 'App',
  components: {
    AddEntityScreen,
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  margin-top: 60px;
}

h1 {
  text-align: center;
}
</style>
