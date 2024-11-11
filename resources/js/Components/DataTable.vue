<template>
  <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
    <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th v-for="field in fields" :key="field.key" class="px-4 py-4">
          <slot :name="`header(${field.key})`" v-bind="field">
            <slot name="header" v-bind="field">
              {{ field.key }}
            </slot>
          </slot>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in rows" :key="index" class="border-b dark:border-gray-700">
        <td v-for="field in fields" :key="field.key" class="px-4 py-3">
          <slot :name="`cell(${field.key})`" v-bind="{
            item,
            index,
            value: item[field.key],
            field
          }">
            <slot name="cell" v-bind="{
              item,
              index,
              value: item[field.key],
              field
            }">
              {{ item[field.key] }}
            </slot>
          </slot>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script setup>

const { rows, fields } = defineProps({
  rows: {
    type: Array,
    required: true
  },
  fields: {
    type: Array,
    required: true
  }
})

</script>