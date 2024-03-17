<template>
    <div>
      <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-4">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous" v-if="pagination.current_page > 1" @click="changePage(pagination.current_page - 1)">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li v-for="page in pagination.last_page" :key="page" class="page-item" :class="{ 'active': page === pagination.current_page }" >
                    <button type="button" class="page-link" @click="changePage(page)" :disabled="page === pagination.current_page">{{ page }}</button>
                </li>

                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next" v-if="pagination.current_page < pagination.last_page" @click="changePage(pagination.current_page + 1)">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
  </template>

  <script>
  export default {
    name:'Pagination',
    props: ['pagination'],
    methods: {
      changePage(page) {
        this.$emit('page-changed', page);
      },
    },
  };
  </script>

  <style scoped>
  .pagination {
    list-style: none;
    display: flex;
  }

  .pagination li {
    margin: 0 5px;
  }

  .pagination a {
    text-decoration: none;
    padding: 5px 10px;
    border: 1px solid #ccc;
    cursor: pointer;
  }

  .pagination a:hover {
    background-color: #eee;
  }

  .pagination .active {
    background-color: #007bff;
    color: #fff;
  }
  </style>
