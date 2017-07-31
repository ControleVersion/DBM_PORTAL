<table class="table table-bordered">
   <tr>
       <th>Titulo</th>
       <th>Imagem</th>
   </tr>
   @foreach ($products as $product)
   <tr>
       <td>{{ $product->titulo_destaque }}</td>
       <td>{{ $product->imagem_destaque }}</td>
   </tr>
   @endforeach
</table>
   {!! $products->links() !!}
