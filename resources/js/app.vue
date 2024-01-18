<template>
    <div class="flex c_font">
        <div v-for="i in 10" key="i" class="truck">
            Truck - {{ i }}
        </div>
    </div>
</template>


<script>
export default {
    name: "root"
}
</script>

<style>
.c_font {
    color:white;
    font-weight: bold;
    width: 5rem;
    flex-flow: column;
}

.truck {
    cursor: pointer;
}
.truck:hover {
    color:red
}
</style>
