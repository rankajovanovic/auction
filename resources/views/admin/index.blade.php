<x-admin-home>
  @section('content')
  <h1 class="h3 mb-4 text-gray-800">Admin Dashboard</h1>
  <canvas id="myChart" height="100"></canvas>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
  const countUsers = '{{$countUsers}}'
  const countItems = '{{$countItems}}'
  const countBids = '{{$countBids}}'
  const countCategories = '{{$countCategories}}'
  const labels = ['Data of Users', 'Data of Items', 'Data of Bids', 'Data of Categories']

  const ctx = document.getElementById('myChart').getContext('2d');
  const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Users', 'Items', 'Bids', 'Categories'],
      datasets: [{
        label: ['Data of CMS'],
        data: [countUsers, countItems, countBids, countCategories],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
  </script>

  @endsection



</x-admin-home>