<script>
fetch ('https://www.inegi.org.mx/app/api/denue/v1/consulta/buscar/#token')
.then(Response=> Response.json())
.then (json => console.log(json));


</script>