<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
<style type="text/css">

.div_deg
{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 60px;
}
.table_deg
{
    border: 2px solid greenyellow;
}
th 
{
    background-color: skyblue;
    color: white;
    font-size: 19px;
    font-weight: bold;
    padding: 15px;
}
td
{
    border: 1px solid skyblue;
    text-align: center;
    color: white;
}
input[type="search"]
{
    width: 500px;
    height: 60px;
    margin-left: 50px;
}
</style>

  </head>
  <body>
    @include('admin.header')
   
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

            <form action="{{ url('search_product') }}" method="get">
                @csrf
                <input type="search" name="search" placeholder="Search Product...">
            
                <input type="submit" class="btn btn-secondary" value="Search">
            </form>

        <div class="div_deg">
            <table class="table_deg">
                <tr>
                <th>Product Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach ($data as $product)
                     
            <tr>
                <td>{{ $product->title }}</td>
                <td>{!!Str::limit($product->description,10) !!}</td>
                <td>{{ $product->category }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>
                    <img src="{{ asset('products/'.$product->image) }}" alt="Product Image" style="width: 120px; height: 120px;">
                </td>

                 <td>
                    <a class="btn btn-success" href="{{ url('update_product',$product->id) }}">Edit</a>
                 </td>

                <td>
                    <a class="btn btn-danger" onclick="confirmation(event)" href="{{ url('delete_product',$product->id) }}">Delete</a>
                </td>
            </tr>

            @endforeach
            </table>  
        </div>
        <div class="div_deg">
        {{ $data->links() }}
        </div>


          </div>
      </div>
    </div>
  @include('admin.js')



  <script type="text/javascript">
    function confirmation(ev) {
       ev.preventDefault();

       var urlToRedirect = ev.currentTarget.getAttribute('href');

       console.log(urlToRedirect);

       swal({
        title: "Are you sure to delete this?",
        text: "You will not be able to recover this category!",
        icon: "warning",
        buttons: true,
      }).then((willCancel) => {
           if(willCancel) {

            window.location.href = urlToRedirect;

           }
      });
       
    }

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


  </body>
</html>