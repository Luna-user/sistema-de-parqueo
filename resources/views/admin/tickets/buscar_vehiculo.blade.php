<div class="row">
    <div class="col-md-6">
        <p><b>Informacion del Cliente</b></p>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombres"><i class="fas fa-user-check"></i>Nombre Completo</label>
                    <p>{{ $vehiculo->cliente->nombres }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="numero_documento"><i class="fas fa-id-card"></i>Numero de Documento</label>
                    <p>{{ $vehiculo->cliente->numero_documento }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i>Correo Electronico</label>
                    <p>{{ $vehiculo->cliente->email }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="telefono"><i class="fas fa-phone"></i>Telefono</label>
                    <p>{{ $vehiculo->cliente->telefono }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <p><b>Informacion del Vehiculo</b></p>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="placa">Placa del Vehículo</label>
                    <p>{{ $vehiculo->placa }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="marca">Marca del Vehículo</label>
                    <p>{{ $vehiculo->marca }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="modelo">Modelo del Vehiculo</label>
                    <p>{{ $vehiculo->modelo }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="color">Color del Vehiculo</label>
                    <p>{{ $vehiculo->color }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tipo">Tipo del Vehiculo</label>
                    <p>{{ $vehiculo->tipo }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

