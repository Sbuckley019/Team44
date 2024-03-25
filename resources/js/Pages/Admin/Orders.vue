<template>
    <AdminLayout>
      <div class="font-roboto text-footer mx-auto p-4">
        <Header>Order Management</Header>
        <div class="flex justify-between items-center my-4">
          <SecondaryButton @click="CreateOrder">
            New Order
          </SecondaryButton>
          <div class="flex space-x-2">
            <input
              type="text"
              v-model="search"
              placeholder="Search orders"
              class="p-2 border-2 border-gray-300"
            />
            <select v-model="statusFilter" class="p-2 border-2 border-gray-300">
              <option value="">All</option>
              <option value="pending">Pending</option>
              <option value="shipped">Shipped</option>
              <option value="delivered">Delivered</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>
        </div>
        <div id="table" class="mt-4 w-full shadow-md">
          <table class="border-collapse w-full">
            <thead>
              <tr class="hover:bg-footer">
                <TableHeader> Order ID </TableHeader>
                <TableHeader> Customer Name </TableHeader>
                <TableHeader> Total Price </TableHeader>
                <TableHeader> Status </TableHeader>
                <TableHeader> Actions </TableHeader>
                <TableHeader> Order Date </TableHeader>
              </tr>
            </thead>
            <tbody>
              <tr v-for="order in filteredOrders" :key="order.id">
                <TableCell>
                  {{ order.id }}
                </TableCell>
                <TableCell>
                  {{ order.customer_name }}
                </TableCell>
                <TableCell> £{{ order.total_price }} </TableCell>
                <TableCell>
                  {{ order.status }}
                </TableCell>
                <TableCell>
                  <SecondaryButton @click="viewOrder(order.id)">
                    View
                  </SecondaryButton>
                  <SecondaryButton
                    @click="processOrder(order)"
                    :disabled="order.status === 'Shipped'"
                  >
                    Process
                  </SecondaryButton>
                </TableCell>
                <TableCell>
                  {{ order.date }}
                </TableCell>
              </tr>
              <tr v-if="filteredOrders.length === 0">
                <TableCell colspan="6">No orders found</TableCell>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </AdminLayout>
  </template>
  
  <script setup>
import { ref, computed } from 'vue';
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Header from "@/Components/Header.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TableHeader from "@/Components/TableHeader.vue";
import TableCell from "@/Components/TableCell.vue";
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
  orders: Array
});

const search = ref('');
const statusFilter = ref('');

const filteredOrders = computed(() => {
  return props.orders.filter((order) => {
    const matchesSearch = search.value.length === 0 || 
                          order.customer_name.toLowerCase().includes(search.value.toLowerCase()) || 
                          order.id.toString().includes(search.value);
    const matchesStatus = statusFilter.value.length === 0 || 
                          order.status.toLowerCase() === statusFilter.value;
    return matchesSearch && matchesStatus;
  });
});

const createOrder = () => {
    Inertia.visit('/Admin/Orders/Create');
};

const viewOrder = (orderId) => {
    Inertia.visit(`/Admin/Orders/${orderId}`);
};

const processOrder = (order) => {
    // Define the logic for processing the order here
    // For example, you could send a PUT request with Inertia or axios
};
</script>

  
  <style scoped>
  #table tr:nth-child(even) {
      background-color: #f2f2f2;
  }
  </style>
  