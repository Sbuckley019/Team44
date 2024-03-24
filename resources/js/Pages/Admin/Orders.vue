<template>
    <AdminLayout> 
        <div class="admin-orders">
        <h1>Order Management</h1>
        <div class="orders-list">
          <table>
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Actions</th>
                <th>Order Date</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="order in orders" :key="order.id">
                <td>{{ order.id }}</td>
                <td>{{ order.customer_name }}</td>
                <td>{{ order.total_price | currency }}</td>
                <td>{{ order.status }}</td>
                <td>
                  <!-- Action Buttons -->
                  <button @click="viewOrder(order.id)">View</button>
                  <button @click="processOrder(order)" :disabled="order.status === 'Shipped'">Process</button>
                </td>
                <td>{{ order.date }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </AdminLayout> 
  </template>
  
  <script>
  import AdminLayout from "@/Layouts/AdminLayout.vue";
  
  export default {
    props: {
      orders: Array // This will be populated by Inertia, so you don't need it in data
    },
    components: {
      AdminLayout
    },
    methods: {
      viewOrder(orderId) {
        const url = `/Admin/Orders/${orderId}`;
        console.log(`Attempting to navigate to order ${orderId}`);
        this.$inertia.visit(url);
      },
      processOrder(order) {
        // Logic to process the order, such as updating its status to 'Shipped'
      }
    },
    filters: {
      currency(value) {
        // A simple filter to format the price as a currency
        return `$${value.toFixed(2)}`;
      }
    }
  };
  </script>
    
  
    <style scoped>
    .admin-orders {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: #333;
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }
    
    .admin-orders h1 {
      color: #2c3e50;
      margin-bottom: 20px;
    }
    
    .orders-list {
      margin-top: 20px;
      border-collapse: collapse;
      width: 100%;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .orders-list table {
      width: 100%;
      border-collapse: collapse;
    }
    
    .orders-list th,
    .orders-list td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    
    .orders-list th {
      background-color: #3498db;
      color: white;
      white-space: nowrap;
    }
    
    .orders-list td {
      font-size: 14px;
      line-height: 20px;
    }
    
    .orders-list tr:nth-child(even) {
      background-color: #f2f2f2;
    }
    
    .orders-list tr:hover {
      background-color: #ddd;
    }
    
    button {
      background-color: #3498db;
      color: white;
      border: none;
      padding: 10px 20px;
      margin: 5px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    
    button:disabled {
      background-color: #95a5a6;
    }
    
    button:hover:not(:disabled) {
      background-color: #2980b9;
    }
    
    /* Responsive styling */
    @media (max-width: 768px) {
      .orders-list th, .orders-list td {
        padding: 10px;
      }
    
      button {
        padding: 5px 10px;
        font-size: 14px;
      }
    }
    </style>
    
