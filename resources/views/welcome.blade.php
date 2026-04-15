<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizador Digital Pro | Multi-Servicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

    <style>
        :root {
            --brand-color: #003399;
            --brand-hover: #002673;
            --bg-main: #f1f5f9;
            --text-main: #1e293b;
        }
        .tema-Espumas { --brand-color: #003399; --brand-hover: #001a4d; }
        .tema-Pethelios { --brand-color: #9f6131; --brand-hover: #7d4a24; }

        body {
            background-color: var(--bg-main);
            padding-top: 30px;
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
        }

        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1), 0 1px 2px rgba(0,0,0,0.06);
            margin-bottom: 1.5rem;
        }

        .header-card {
            background: white;
            border-left: 5px solid var(--brand-color);
        }

        .seccion-titulo {
            color: var(--brand-color);
            font-size: 0.75rem;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            font-weight: 800;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }
        .seccion-titulo::after {
            content: "";
            flex-grow: 1;
            height: 1px;
            background: #cbd5e1;
            margin-left: 15px;
        }

        .form-label { margin-bottom: 0.4rem; color: #64748b; font-size: 0.8rem; }
        .form-select, .form-control {
            border-color: #e2e8f0;
            font-size: 0.9rem;
            padding: 0.6rem;
            border-radius: 8px;
        }

        .btn-add {
            background-color: var(--brand-color);
            color: white;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 0.6rem 1.5rem;
            transition: all 0.2s;
            height: 42px;
            border: none;
        }
        .btn-add:hover {
            background-color: var(--brand-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .lista-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .item-servicio {
            border-bottom: 1px solid #f1f5f9;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .extra-check-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 10px;
            transition: all 0.3s;
            cursor: pointer;
        }
        .extra-check-card:hover { border-color: var(--brand-color); }
        .form-check-input:checked + .form-check-label { color: var(--brand-color); font-weight: 600; }

        .resumen-total-box {
            background: #f8fafc;
            padding: 24px;
            border-top: 1px solid #e2e8f0;
        }

        #contenedor_descuento_toggle { display: none; margin-top: 10px; }

        .btn-primary-custom {
            background-color: var(--brand-color);
            border: none;
            padding: 15px;
            font-weight: 700;
            border-radius: 10px;
            letter-spacing: 0.5px;
            color: white;
            transition: all 0.3s;
        }
        .btn-primary-custom:hover {
            background-color: var(--brand-hover);
            filter: brightness(1.1);
        }
    </style>
</head>
<body id="main-body" class="tema-Espumas">

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">

            <div class="card header-card">
                <div class="card-body d-flex align-items-center justify-content-between py-2 px-4">
                    <div class="d-flex align-items-center">
                        <img id="img-logo" src="/imagen/LOGOPNG.png" alt="Logo" style="max-height: 45px;" class="me-3" crossorigin="anonymous" onerror="this.src='https://via.placeholder.com/150x50?text=LOGO'">
                        <div>
                            <h6 class="mb-0 fw-bold" style="font-size: 1.1rem;">Cotizador Pro</h6>
                            <select id="empresa_selector" class="form-select form-select-sm border-0 fw-semibold p-0 text-muted" onchange="cambiarEmpresa()" style="width: auto; background-color: transparent;">
                                <option value="Espumas">Espumas Nicaragua</option>
                                <option value="Pethelios">Pethelios Nicaragua</option>
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger px-3" onclick="limpiarTodo()" style="font-size: 0.75rem; border-radius: 20px;">
                        <i class="fas fa-sync-alt me-1"></i> Reiniciar
                    </button>
                </div>
            </div>

            <div class="mb-4">
    <div class="form-check form-switch mb-3">
        <input class="form-check-input" type="checkbox" id="activar_cliente" onclick="toggleCliente()">
        <label class="form-check-label fw-bold text-primary" for="activar_cliente uppercase">
            ¿INCLUIR DATOS DEL CLIENTE?
        </label>
    </div>

    <div id="seccion_cliente" style="display: none;" class="p-3 border rounded bg-light">
        <h6 class="seccion-titulo text-dark mb-3">
            <i class="fas fa-user-edit me-2"></i> Datos del Cliente
        </h6>
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label fw-semibold small">Nombre Completo</label>
                <input type="text" id="cliente_nombre" class="form-control form-control-sm" placeholder="Nombre del cliente">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold small">Dirección</label>
                <input type="text" id="cliente_direccion" class="form-control form-control-sm" placeholder="Dirección exacta">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold small">Teléfono</label>
                <input type="tel" id="cliente_tel" class="form-control form-control-sm" placeholder="0000-0000" maxlength="9">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold small">Cédula / RUC</label>
                <input type="text" id="cliente_cedula" class="form-control form-control-sm" placeholder="ID del cliente">
            </div>
        </div>
    </div>
</div>
<h6 class="seccion-titulo"><i class="fas fa-map-marker-alt me-2"></i> <span id="label_seccion_logistica">Logística de Entrega</span></h6>

            <div class="card p-4">
                <h6 class="seccion-titulo"><i class="fas fa-map-marker-alt me-2"></i> <span id="label_seccion_logistica">Logística de Entrega</span></h6>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Zona</label>
                        <select id="trans_zona" class="form-select" onchange="actualizarRutas()"></select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Ruta de Cobertura</label>
                        <select id="trans_ruta" class="form-select" onchange="actualizarSubRutas()" disabled></select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Destino</label>
                        <select id="trans_subruta" class="form-select" onchange="agregarTransporte()" disabled></select>
                    </div>
                </div>

                <h6 class="seccion-titulo"><i class="fas fa-th-list me-2"></i> <span id="label_seccion_configuracion">Configuración de Servicios</span></h6>
                <div class="row g-3 align-items-end mb-4">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold" id="label_categoria">Categoría</label>
                        <select id="cat_servicio" class="form-select" onchange="filtrarServicios()"></select>
                    </div>
                    <div class="col-md-3" id="container_subtipo_vehiculo" style="display:none;">
                        <label class="form-label fw-semibold">Tipo de Vehículo</label>
                        <select id="subtipo_vehiculo" class="form-select" onchange="filtrarItemsVehiculo()"></select>
                    </div>
                    <div class="col-md-3 flex-grow-1">
                        <label class="form-label fw-semibold" id="label_servicio">Servicio a Realizar</label>
                        <select id="item_servicio" class="form-select"></select>
                    </div>
                    <div class="col-md-1" style="min-width: 80px;">
                        <label class="form-label fw-semibold">Cant.</label>
                        <input type="number" id="cant_servicio" class="form-control text-center" value="1" min="1">
                    </div>
                <div id="contenedor-descripcion" class="col-12" style="display: none; margin-bottom: 15px;">
    <label style="font-weight: bold; color: #1a4a8e;">
        Descripción del Servicio Especial <span style="color:red;">*</span>
    </label>
    <textarea id="descripcion_servicio" class="form-control" rows="2"
              placeholder="Escriba los detalles aquí (Campo obligatorio)..." required></textarea>
</div>

<div class="col-md-auto">
    <button type="button" class="btn btn-add" onclick="agregarServicioAMemoria()">
        <i class="fas fa-plus me-2"></i>Agregar
    </button>
</div>

                <div id="seccion_extras" style="display:none;">
                    <h6 class="seccion-titulo"><i class="fas fa-plus-circle me-2"></i> Cargos Extras por Mobiliario</h6>
                    <div class="row mb-4" id="contenedor_checks_extras"></div>
                </div>

                <div class="lista-container mt-2">
                    <div class="bg-light p-3 border-bottom d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-secondary small"><i class="fas fa-shopping-cart me-2"></i>RESUMEN DE COTIZACIÓN</span>
                        <span id="badge-items" class="badge rounded-pill bg-secondary" style="font-size: 0.7rem;">0 items</span>
                    </div>

                    <div id="lista_visual" style="min-height: 100px;"></div>

                    <div class="resumen-total-box">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="aplicar_descuento" onchange="toggleDescuento()">
                                    <label class="form-check-label small fw-bold text-primary" for="aplicar_descuento">¿Aplicar descuento especial?</label>
                                </div>
                                <div id="contenedor_descuento_toggle">
                                    <div class="input-group input-group-sm" style="max-width: 250px;">
                                        <select id="tipo_descuento" class="form-select w-25" onchange="renderLista()">
                                            <option value="porcentaje">%</option>
                                            <option value="fijo">Valor</option>
                                        </select>
                                        <input type="number" id="valor_descuento" class="form-control w-50" placeholder="0.00" oninput="renderLista()">
                                    </div>
                                </div>
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" id="aplicar_iva" onchange="renderLista()">
                                    <label class="form-check-label small fw-semibold" for="aplicar_iva">Aplicar Impuesto IVA (15%)</label>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex flex-column align-items-end justify-content-center">
                                <div id="resumen_totales" class="text-end w-100"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <button onclick="generarPDF()" class="btn btn-primary-custom btn-lg w-100 mt-4 shadow-sm">
                    <i class="fas fa-file-pdf me-2"></i>GENERAR DOCUMENTO PDF
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    const logisticaEmpresas = {
        "Espumas": {
            "Managua": {
                "Carretera a Masaya": {
                    "Carretera a masaya (Managua)": 0, "KM 13 en adelante": 185, "Ticuantepe": 370, "Veracruz": 0, "Nindiri": 555, "Masaya": 740, "Catarina": 925, "Niquinohomo": 925, "Diriamba": 740, "Diriomo": 925, "Diria": 925, "Nandasmo": 925, "Granada": 925, "Apoyo": 925, "Rivas": 1480, "San Juan Del Sur": 1850, "Tola": 2220, "Peñas Blancas": 2220, "Nandaime": 1295
                },
                "Carretera Norte": {
                    "Carretera a Norte (Managua)": 0, "Tipitapa": 555, "Boaco": 1480, "San benito": 740, "Juigalpa - Chontales": 1850, "Santo Tomas - Chontales": 2590, "Ciudad Dario": 1110, "Camoapa": 1850
                },
                "Carretera Sur": {
                    "Carretera Sur hasta el km 10": 0, "Monte Tabor o INCAE": 370, "El crucero": 555, "Carazo": 925, "Santa Teresa": 925, "La conquista": 925, "Jinotepe": 925, "Masatepe": 740, "Diriamba": 740, "La boquita": 1480, "Los cedros ctra. Sur": 370, "Puerto Sandino": 1295
                },
                "Carretera Nueva Leon": {
                    "Carretera N. Leon (Managua)": 0, "Ciudad Sandino": 0, "Los Brasiles": 185, "Ciudad el Doral": 185, "Mateare": 370, "Vistas de momotombo": 370, "Nagarote": 925, "La Paz Centro": 1110
                },
                "Managua Centro": {
                    " Managua Centro": 0,
                }

            },
            "Zona Norte": {
                "ESTELI / Carre Pana Nor": {
                    "Esteli": 1850, "Condega": 2220, "Pueblo Nuevo": 2590, "Palacaguina": 2590, "Yanli": 2590, "Somoto": 3700, "Ocotal": 3700, "Jalapa": 3700, "San Rafael del Norte": 2590, "Quilali": 2590, "La concordia": 2590
                },

                "Carret Pana Sur": {
                    "La Cruz": 1480, "La trinidad": 1295, "San Isidro": 1295, "Sebaco": 1295, "Matagalpa": 1480, "Jinotega": 1850, "Dario": 1110, "Muymuy": 1850, "Matiguas": 1850
                }
            },
            "Occidente": {
                "Chinandega-Carretera Leon": { "Chichigalpa": 370, "Posoltega": 370, "Telica": 740, "Leon": 740, "Poneloya": 925 },
                "Carretera Somotillo": { "Rancheria": 555, "La villa 15 de julio": 740, "Villa Nueva": 1110, "Somotillo": 1295, "5 Pinos": 1480, "Sto. Tomas del Norte": 1480, "El Sauce": 1480, "Mina el Limon": 1480, "Guasaule": 1480 },
                "Carretera El Viejo": { "Carretera El Viejo": 185, "Tonala": 370, "Jiquilillo": 555, "Cosiguina": 925 },
                "Carretera El Realejo / Corinto": { "El Realejo": 370, "Paso Caballo": 370, "Corinto": 370 }
            }
        },
        "Pethelios": {
            "Managua": {
                "Carretera a Masaya": { "Carretera a masaya (Managua)": 30, "KM 13 en adelante": 50, "Ticuantepe": 50, "Veracruz": 30, "Nindiri": 50,"Masaya": 60, "Granada": 70, "Catarina": 70,"Niquinohomo": 50, "Diriamba": 50, "Diriomo":50, "Diria": 50, "Nandasmo": 50, "Apoyo": 60, "Rivas": 100, "San Juan Del Sur": 120, "Tola": 120, "Peñas Blancas": 130, "Nandaime": 80 },
                "Carretera Norte": { "Carretera Norte (Managua)": 30, "Tipitapa": 40, "Boaco": 80, "San benito": 50, "Juigalpa - Chontales": 100, "Santo Tomas - Chontales": 140, "Ciudad Dario": 60, "Camoapa": 100},
               "Carretera N. Leon": { "Carretera N. leon (Managua)": 30, "ciudad sandino": 30, "Los Brasiles": 40, "Mateare": 50, "Vistas de momotombo": 40, "Nagarote": 60, "Ciudad Dario": 60, "La Paz Centro": 70},
               "Carretera Sur": { "Carretera Sur hasta el km 10": 30, "Managua. Monte Tabor o INCAE": 30, "El crucero": 60, "Carazo": 70, "Santa Teresa": 70, "La conquista": 50, "Jinotepe": 70, "Masatepe": 60, "Diriamba":60, "La boquita":100, "Los cedros ctra. Sur": 30, "Puerto Sandino": 100},
                },
                "Zona Norte": {
                "ESTELI / Carre Pana Nor": {
                    "Esteli": 100, "Condega": 120, "Pueblo Nuevo": 140, "Palacaguina": 140, "Yanli": 140, "Somoto": 100, "Ocotal": 100, "Jalapa": 100, "San Rafael del Norte": 140, "Quilali": 140, "La concordia": 140
                },
                  "Carret Pana Sur": {
                    "La Cruz":120, "La trinidad": 120, "San Isidro": 120, "Sebaco": 120, "Matagalpa": 100, "Jinotega": 140, "Dario": 120, "Muymuy": 140, "Matiguas": 140
                },
            },
 "Occidente": {
                "Chinandega-Carretera Leon": { "Chichigalpa": 120, "Posoltega": 120, "Telica": 140, "Leon": 140, "Poneloya": 140 },
                "Carretera Somotillo": { "Rancheria": 120, "La villa 15 de julio": 140, "Villa Nueva": 100, "Somotillo": 120, "5 Pinos": 140, "Sto. Tomas del Norte": 140, "El Sauce": 140, "Mina el Limon": 140, "Guasaule": 140 },
                "Carretera El Viejo": { "Carretera El Viejo": 120, "Tonala": 140, "Jiquilillo": 120, "Cosiguina": 120 },
                "Carretera El Realejo / Corinto": { "El Realejo": 120, "Paso Caballo": 140, "Corinto": 140 }
            }


        }
    };

    const serviciosGlobal = {
        "Espumas": {
            "Vehículo": {
                "Limpieza Profunda": [
                { nombre: "Sedan Económico LP", precio: 2800 },
                 { nombre: "Sedan de lujo. LP (bmw, mercedes benz, audi, etc.)", precio: 3200 },
                 { nombre: "Sedan de lujo Sin retirar asientos (bmw, mercedes benz, audi, etc.)-LP", precio: 2800 },
                 { nombre: "Camioneta de 1 cabina- LP", precio: 2800 },
                { nombre: "Camioneta Doble cabina- LP", precio: 3500 },
                { nombre: "Camioneta tipo SUV- LP", precio: 3500 },
                { nombre: "Camioneta de 3 filas de asientos (Prado, Rush, montero, etc)-LP", precio: 3900 },
                { nombre: "Camioneta de lujo (bmw, mercedes, audi, etc.)-LP", precio: 3900 },
                { nombre: "Camioneta de lujo. Sin retirar asientos (bmw, mercedes, audi, etc.)-LP", precio: 3500 },
                { nombre: "Camionetas Grandes (coronella, linconl, RAM, etc)-LP", precio: 4900 },
                { nombre: "JEEP-LP", precio: 3900 },
                { nombre: "Microbus de 16 pasajeros-LP", precio: 6500 },
                { nombre: "Microbus de 24 pasajeros-LP", precio: 9800 },
                { nombre: "Camion de 2 TNL (Cabina)-LP", precio: 2800 },
                { nombre: "Camion de 4 TNL (Cabina)-LP", precio: 3500 },
                { nombre: "Camion de 8 TNL (Cabina)-LP", precio: 3900 },
                { nombre: "CABEZAL CABINA SIN CAMA-LP", precio: 4900 },
                { nombre: "CABEZAL CABINA CON CAMA-LP", precio: 7500 }


                ],
                "Detallado Completo": [
                { nombre: "Sedan Economico - DC", precio: 9560},
                { nombre: "Sedan de lujo - DC (bmw, mercedes benz, audi, etc.)", precio: 10260 },
                { nombre: "Sedan de lujo - DC Sin retirar asientos (bmw, mercedes benz, audi, etc.)", precio: 9860 },
                { nombre: "Camioneta de 1 cabina - DC", precio: 9010 },
                { nombre: "Camioneta Doble cabina - DC", precio: 11260 },
                { nombre: "Camioneta tipo SUV - DC", precio: 11260 },
                { nombre: "Camioneta de 3 filas de asientos (Prado, Rush, montero, etc) - DC", precio:  12560},
                { nombre: "Camioneta de lujo - DC (bmw, mercedes, audi, etc.)", precio:  12560 },
                { nombre: "Camioneta de lujo. Sin retirar asientos - DC (bmw, mercedes, audi, etc.)", precio:  12560},
                { nombre: "Camionetas Grandes (coronella, linconl, RAM, etc) - DC", precio: 13660 },
                { nombre: "JEEP - DC", precio: 12560 },
                { nombre: "Microbus de 16 pasajeros - DC", precio: 15380 },
                { nombre: "Microbus de 24 pasajeros - DC", precio: 21980 },
                { nombre: "Camion de 2 TNL (Cabina) - DC", precio: 9010},
                { nombre: "Camion de 4 TNL (Cabina) - DC", precio: 10510 },
                { nombre: "Camion de 8 TNL (Cabina) - DC", precio: 11660 },
                { nombre: "CABEZAL CABINA SIN CAMA - DC", precio:14300 },
                { nombre: "CABEZAL CABINA CON CAMA - DC", precio: 19300 }


                     ],

 "Pulida de Carroceria": [
                { nombre: "Sedan Economico - PC", precio: 2900 },
                { nombre: "Sedan de lujo - PC (bmw, mercedes benz, audi, etc.)", precio: 3200 },
                { nombre: "Sedan de lujo. Sin retirar asientos - PC (bmw, mercedes benz, audi, etc.)", precio: 9860 },
                { nombre: "Camioneta de 1 cabina - PC", precio: 2900 },
                { nombre: "Camioneta Doble cabina - PC", precio: 3900 },
                { nombre: "Camioneta tipo SUV - PC", precio: 3900 },
                { nombre: "Camioneta de 3 filas de asientos (Prado, Rush, montero, etc) - PC", precio: 4800 },
                { nombre: "Camioneta de lujo - PC (bmw, mercedes, audi, etc.)", precio: 4800 },
                { nombre: "Camionetas Grandes (coronella, linconl, RAM, etc) - PC", precio: 4900 },
                { nombre: "JEEP - PC", precio: 4800 },
                { nombre: "Microbus de 16 pasajeros - PC", precio: 6500 },
                { nombre: "Microbus de 24 pasajeros - PC", precio: 9800 },
                { nombre: "Camion de 2 TNL (Cabina) - PC", precio: 2900 },
                { nombre: "Camion de 4 TNL (Cabina) - PC", precio: 3700 },
                { nombre: "Camion de 8 TNL (Cabina) - PC", precio: 4450 },
                { nombre: "CABEZAL CABINA SIN CAMA - PC", precio: 7400 },
                { nombre: "CABEZAL CABINA CON CAMA - PC", precio: 9800 }
            ],
            "Restauracion de Faros": [
                { nombre: "Sedan Economico - RF", precio: 1290 },
                { nombre: "Sedan de lujo - RF (bmw, mercedes benz, audi, etc.)", precio: 1290 },
                { nombre: "Sedan de lujo. Sin retirar asientos (bmw, mercedes benz, audi, etc.)", precio: 1290},
                { nombre: "Camioneta de 1 cabina - RF", precio: 1290 },
                { nombre: "Camioneta Doble cabina - RF", precio: 1290 },
                { nombre: "Camioneta tipo SUV - RF", precio: 1290 },
                { nombre: "Camioneta de 3 filas de asientos (Prado, Rush, montero, etc) - RF", precio: 1290 },
                { nombre: "Camioneta de lujo - RF (bmw, mercedes, audi, etc.)", precio: 1290 },
                { nombre: "Camionetas Grandes (coronella, linconl, RAM, etc) - RF", precio: 1290 },
                { nombre: "JEEP - RF", precio: 1290 },
                { nombre: "Microbus de 16 pasajeros - RF", precio: 1290 },
                { nombre: "Microbus de 24 pasajeros - RF", precio: 1290 },
                { nombre: "Camion de 2 TNL (Cabina) - RF", precio: 1290 },
                { nombre: "Camion de 4 TNL (Cabina) - RF", precio: 1290 },
                { nombre: "Camion de 8 TNL (Cabina) - RF", precio: 1290 },
                { nombre: "CABEZAL CABINA SIN CAMA - RF", precio: 2000 },
                { nombre: "CABEZAL CABINA CON CAMA - RF", precio: 2000 }
            ],
            "Abrillantamiento de rines": [
               { nombre: "Sedan Economico - AR", precio: 1090 },
                { nombre: "Sedan de lujo - AR (bmw, mercedes benz, audi, etc.)", precio: 1090 },
                { nombre: "Sedan de lujo. Sin retirar asientos (bmw, mercedes benz, audi, etc.)", precio: 1090 },
                { nombre: "Camioneta de 1 cabina - AR", precio: 1090 },
                { nombre: "Camioneta Doble cabina - AR", precio: 1090 },
                { nombre: "Camioneta tipo SUV - AR", precio: 1090 },
                { nombre: "Camioneta de 3 filas de asientos (Prado, Rush, montero, etc) - AR", precio: 1090 },
                { nombre: "Camioneta de lujo - AR (bmw, mercedes, audi, etc.)", precio: 1090 },
                { nombre: "Camionetas Grandes (coronella, linconl, RAM, etc) - AR", precio: 1090 },
                { nombre: "JEEP - AR", precio: 1090 },
                { nombre: "Microbus de 16 pasajeros - AR", precio: 1090 },
                { nombre: "Microbus de 24 pasajeros - AR", precio: 1090 },
                { nombre: "Camion de 2 TNL (Cabina) - AR", precio: 1090 },
                { nombre: "Camion de 4 TNL (Cabina) - AR", precio: 1090 },
                { nombre: "Camion de 8 TNL (Cabina) - AR", precio: 1090 },
                { nombre: "CABEZAL CABINA SIN CAMA - AR", precio: 1090 },
                { nombre: "CABEZAL CABINA CON CAMA - AR", precio: 1090 }
            ],
            "Eliminacion de Gotas en Vidrios": [
               { nombre: "Sedan Economico - EGV", precio: 1480 },
                { nombre: "Sedan de lujo - EGV (bmw, mercedes benz, audi, etc.)", precio: 1480 },
                { nombre: "Sedan de lujo - EGV (sin retirar asientos)", precio: 1480 },
                { nombre: "Camioneta de 1 cabina - EGV", precio: 930 },
                { nombre: "Camioneta Doble cabina - EGV", precio: 1480 },
                { nombre: "Camioneta tipo SUV - EGV", precio: 1480 },
                { nombre: "Camioneta de 3 filas de asientos (Prado, Rush, montero, etc) - EGV", precio: 1480 },
                { nombre: "Camioneta de lujo - EGV (bmw, mercedes, audi, etc.)", precio: 1480 },
                { nombre: "Camionetas Grandes (coronella, linconl, RAM, etc) - EGV", precio: 1480 },
                { nombre: "JEEP - EGV", precio: 1480 },
                { nombre: "Microbus de 16 pasajeros - EGV", precio: 190 },
                { nombre: "Microbus de 24 pasajeros - EGV", precio: 190 },
                { nombre: "Camion de 2 TNL (Cabina) - EGV", precio: 980 },
                { nombre: "Camion de 4 TNL (Cabina) - EGV", precio: 980 },
                { nombre: "Camion de 8 TNL (Cabina) - EGV", precio: 980 },
                { nombre: "CABEZAL CABINA SIN CAMA - EGV", precio: 1090 },
                { nombre: "CABEZAL CABINA CON CAMA - EGV", precio: 1090 }
            ],
                      // ACA TERMINA VEHICULO

            },
             "Cama": [
            { nombre: "Colchon Unipersonal (Limpieza Profunda)", precio: 1700 },
            { nombre: "Colchon Matrimonial (Limpieza Profunda)", precio: 1900 },
            { nombre: "Colchon Queen (Limpieza Profunda)", precio: 2100 },
            { nombre: "Colchon King (Limpieza Profunda)", precio: 2200 },
            { nombre: "Colchoneta Unipersonal (Limpieza Profunda)", precio: 850 },
            { nombre: "Colchoneta Matrimonial (Limpieza Profunda)", precio: 950 },
            { nombre: "Colchoneta Queen (Limpieza Profunda)", precio: 1300 },
            { nombre: "Colchón de cuna (Limpieza Profunda)", precio: 950 },
            { nombre: "Moises de bebe (Limpieza Profunda)", precio: 950 }
        ],
        //ACA TERMINA CAMA

        "Muebles": [
            { nombre: "Juego 3,2,1 (Limpieza Profunda)", precio: 2600 },
            { nombre: "Juego de 4,3,2 (Limpieza Profunda)", precio: 3200 },
            { nombre: "Juego de 3,2 (Limpieza Profunda)", precio: 2400 },
            { nombre: "Sofá Esquinero (Limpieza Profunda)", precio: 2600 },
            { nombre: "Sofa Cama (Limpieza Profunda)", precio: 2100 },
            { nombre: "Sofá Unipersonal (Limpieza Profunda)", precio: 1100 },
            { nombre: "Sofá doble (Limpieza Profunda)", precio: 1400 },
            { nombre: "Sofá triple (Limpieza Profunda)", precio: 1600 },
            { nombre: "Sofa Cuadruple (Limpieza Profunda)", precio: 2000 }
        ],

        "Baños": [
            { nombre: "Medio Baño (Limpieza Profunda)", precio: 1950 },
            { nombre: "Standard (Limpieza Profunda)", precio: 2800 },
            { nombre: "Grande (Limpieza Profunda)", precio: 3500 },
            { nombre: "Jacuzzi (Limpieza Profunda)", precio: 1500 },
            { nombre: "Puerta de vidrio (Limpieza Profunda)", precio: 600 },
            { nombre: "Bateria de Baños (Limpieza Profunda)", precio: 3700 },
            { nombre: "Inodoro (Limpieza Profunda)", precio: 740 },
            { nombre: "Urinario(Limpieza Profunda)", precio: 550 },
            { nombre: "Lavamanos(Limpieza Profunda)", precio: 400 }
        ],


        "Sillas": [
            { nombre: "Sillas de Espera (Limpieza Profunda)", precio: 260 },
            { nombre: "Sillas ejecutivas medianas (Limpieza Profunda)", precio: 400 },
            { nombre: "Sillas ejecutivas Grandes (Limpieza Profunda)", precio: 600 },
            { nombre: "Sillas de vehiculos para bebe (Limpieza Profunda)", precio: 800 }
        ],

        "Maletas O Bolsos de Viaje": [
            { nombre: "Maleta pequeña(Limpieza Profunda)", precio: 500 },
            { nombre: "Maleta mediana(Limpieza Profunda)", precio: 700 },
            { nombre: "Maleta grande(Limpieza Profunda)", precio: 900 }
        ],
            "Alfombras Fijas": [
                { nombre: "Alfombras Fijas (M2)", precio_bajo: 250, precio_alto: 150, limite: 100, dinamico: true }
            ],
            "Vidrios": [
                { nombre: "Limpieza de Vidrios (M2)", precio_bajo: 250, precio_alto: 150, limite: 100, dinamico: true }
            ],
            "Pisos": [
                { nombre: "Limpieza de Pisos (M2)", precio_bajo: 250, precio_alto: 150, limite: 100, dinamico: true }
            ],
            "Sanetización": [
                { nombre: "Sanetización (M2)", precio_bajo: 20, precio_alto: 10, limite: 1000, dinamico: true }
            ],
              "Otros": [
            { nombre: "Otros", precio: 3700 }

        ]
        },
        "Pethelios": {
            "Cremacion veterinaria & Funeraria": [
                { nombre: "Cremacion/0-10 LBS", precio: 100 },
                { nombre: "Cremacion/11-20 LBS", precio: 120 },
                { nombre: "Cremacion/21-30 LBS", precio: 140 },
                { nombre: "Cremacion/31-40 LBS", precio: 160 },
                { nombre: "Cremacion/41-50 LBS", precio: 180 },
                { nombre: "Cremacion/51-60 LBS", precio: 220 },
                { nombre: "Cremacion/61-70 LBS", precio: 260 },
                { nombre: "Cremacion/71-80 LBS", precio: 280 },
                { nombre: "Cremacion/81-90 LBS", precio: 320 },
                { nombre: "Cremacion/91-100 LBS", precio: 360},
                { nombre: "Cremacion/101-110 LBS", precio: 400},
                { nombre: "Cremacion/111-120 LBS", precio: 440 }

            ],
             "Urnas para veterinaria & Funeraria": [
                { nombre: "Urna/0-10 LBS", precio: 30 },
                { nombre: "Urna/11-20 LBS", precio: 40 },
                { nombre: "Urna/21-30 LBS", precio: 50 },
                { nombre: "Urna/31-40 LBS", precio: 60 },
                { nombre: "Urna/41-50 LBS", precio: 70 },
                { nombre: "Urna/51-60 LBS", precio: 80 },
                { nombre: "Urna/61-70 LBS", precio: 90 },
                { nombre: "Urna/71-80 LBS", precio: 100 },
                { nombre: "Urna/81-90 LBS", precio: 110 },
                { nombre: "Urna/91-100 LBS", precio: 120},
                { nombre: "Urna/101-110 LBS", precio: 130},
                { nombre: "Urna/111-120 LBS", precio: 140 }

            ],

             "Cremacion Para Publico General": [
                { nombre: "Cremacion/0-10 LBS", precio: 130 },
                { nombre: "Cremacion/11-20 LBS", precio: 160 },
                { nombre: "Cremacion/21-30 LBS", precio: 180 },
                { nombre: "Cremacion/31-40 LBS", precio: 200 },
                { nombre: "Cremacion/41-50 LBS", precio: 230 },
                { nombre: "Cremacion/51-60 LBS", precio: 280 },
                { nombre: "Cremacion/61-70 LBS", precio: 330 },
                { nombre: "Cremacion/71-80 LBS", precio: 360 },
                { nombre: "Cremacion/81-90 LBS", precio: 410 },
                { nombre: "Cremacion/91-100 LBS", precio: 460},
                { nombre: "Cremacion/101-110 LBS", precio: 520},
                { nombre: "Cremacion/111-120 LBS", precio: 570 }

            ],
            "Urnas para Publico General": [
                { nombre: "Urna/0-10 LBS", precio: 40 },
                { nombre: "Urna/11-20 LBS", precio: 50 },
                { nombre: "Urna/21-30 LBS", precio: 60 },
                { nombre: "Urna/31-40 LBS", precio: 70 },
                { nombre: "Urna/41-50 LBS", precio: 80 },
                { nombre: "Urna/51-60 LBS", precio: 90 },
                { nombre: "Urna/61-70 LBS", precio: 110 },
                { nombre: "Urna/71-80 LBS", precio: 110 },
                { nombre: "Urna/81-90 LBS", precio: 120 },
                { nombre: "Urna/91-100 LBS", precio: 130},
                { nombre: "Urna/101-110 LBS", precio: 140},
                { nombre: "Urna/111-120 LBS", precio: 150 }

            ]
        }
    };

    const extrasEspumas = [
        { id: "e1", nombre: "Base Unipersonal", precio: 500 },
        { id: "e2", nombre: "Base Matrimonial", precio: 600 },
        { id: "e3", nombre: "Base Queen", precio: 600 },
        { id: "e4", nombre: "Base King", precio: 600 },
        { id: "e5", nombre: "Traslado de alfombras", precio: 200 }
    ];

    const logosEmpresas = {
        "Espumas": "/imagen/LOGOPNG.png",
        "Pethelios": "/imagen/LOGOPETHELIOS.png"
    };

    let carrito = [];

    function cambiarEmpresa() {
        const emp = document.getElementById('empresa_selector').value;
        document.getElementById('main-body').className = 'tema-' + emp;
        document.getElementById('img-logo').src = logosEmpresas[emp];

        const empText = {
            "Pethelios": { log: "Transporte", conf: "Cremación", cat: "Servicios", ser: "Peso" },
            "Espumas": { log: "Logística de Entrega", conf: "Configuración de Servicios", cat: "Categoría", ser: "Servicio a Realizar" }
        };

        document.getElementById('label_seccion_logistica').innerText = empText[emp].log;
        document.getElementById('label_seccion_configuracion').innerText = empText[emp].conf;
        document.getElementById('label_categoria').innerText = empText[emp].cat;
        document.getElementById('label_servicio').innerText = empText[emp].ser;

        carrito = [];
        llenarZonas(emp);
        llenarCategorias(emp);
        document.getElementById('seccion_extras').style.display = (emp === "Espumas") ? "block" : "none";
        if(emp === "Espumas") renderChecksExtras();
        renderLista();
    }

    function renderChecksExtras() {
        const container = document.getElementById('contenedor_checks_extras');
        container.innerHTML = "";
        extrasEspumas.forEach(ex => {
            container.innerHTML += `
                <div class="col-md-4 col-sm-6">
                    <div class="extra-check-card">
                        <div class="form-check">
                            <input class="form-check-input check-extra-item" type="checkbox" id="${ex.id}" data-nombre="${ex.nombre}" data-precio="${ex.precio}" onchange="sincronizarExtras()">
                            <label class="form-check-label small" for="${ex.id}">${ex.nombre} <br><span class="text-muted">C$ ${ex.precio}</span></label>
                        </div>
                    </div>
                </div>`;
        });
    }

    function sincronizarExtras() {
        carrito = carrito.filter(item => item.tipo !== 'Extra');
        document.querySelectorAll('.check-extra-item:checked').forEach(chk => {
            carrito.push({ tipo: 'Extra', nombre: chk.dataset.nombre, precio: parseFloat(chk.dataset.precio), cant: 1, total: parseFloat(chk.dataset.precio) });
        });
        renderLista();
    }

    function llenarZonas(emp) {
        const zS = document.getElementById('trans_zona');
        zS.innerHTML = '<option value="">Seleccione Zona...</option>';
        if(logisticaEmpresas[emp]) Object.keys(logisticaEmpresas[emp]).forEach(z => zS.innerHTML += `<option value="${z}">${z}</option>`);
    }

    function actualizarRutas() {
        const emp = document.getElementById('empresa_selector').value;
        const zona = document.getElementById('trans_zona').value;
        const rS = document.getElementById('trans_ruta');
        rS.innerHTML = '<option value="">Ruta...</option>';
        rS.disabled = !zona;
        if(zona) Object.keys(logisticaEmpresas[emp][zona]).forEach(r => rS.innerHTML += `<option value="${r}">${r}</option>`);
    }

    function actualizarSubRutas() {
        const emp = document.getElementById('empresa_selector').value;
        const zona = document.getElementById('trans_zona').value;
        const ruta = document.getElementById('trans_ruta').value;
        const sS = document.getElementById('trans_subruta');
        sS.innerHTML = '<option value="">Destino Final...</option>';
        sS.disabled = !ruta;
        if(ruta) Object.keys(logisticaEmpresas[emp][zona][ruta]).forEach(s => sS.innerHTML += `<option value="${s}">${s}</option>`);
    }

    function llenarCategorias(emp) {
        const catS = document.getElementById('cat_servicio');
        catS.innerHTML = '<option value="">Seleccione...</option>';
        if(serviciosGlobal[emp]) Object.keys(serviciosGlobal[emp]).forEach(c => catS.innerHTML += `<option value="${c}">${c}</option>`);
    }

   function filtrarServicios() {
    const emp = document.getElementById('empresa_selector').value;
    const cat = document.getElementById('cat_servicio').value;
    const itemS = document.getElementById('item_servicio');
    const vH = document.getElementById('container_subtipo_vehiculo');

    itemS.innerHTML = '<option value="">--</option>';
    vH.style.display = (cat === "Vehículo") ? "block" : "none";

    if (cat && cat !== "Vehículo") {
        serviciosGlobal[emp][cat].forEach(s => {
            const opt = document.createElement('option');
            opt.value = s.nombre;
            opt.textContent = s.nombre;

            // Si el servicio tiene precios por rango (dinámico)
            if (s.dinamico) {
          opt.dataset.dinamico = "true";
                      opt.dataset.pbajo = s.precio_bajo;
                opt.dataset.palto = s.precio_alto;
                opt.dataset.limite = s.limite;
            } else {
                // Si es un servicio normal con precio único
                opt.dataset.precio = s.precio;
            }
            itemS.appendChild(opt);
        });
    } else if (cat === "Vehículo") {
        const subV = document.getElementById('subtipo_vehiculo');
        subV.innerHTML = '<option value="">Tipo...</option>';
        Object.keys(serviciosGlobal[emp][cat]).forEach(sv => {
            subV.innerHTML += `<option value="${sv}">${sv}</option>`;
        });
    }
}

    function filtrarItemsVehiculo() {
        const emp = document.getElementById('empresa_selector').value;
        const sub = document.getElementById('subtipo_vehiculo').value;
        const itemS = document.getElementById('item_servicio');
        itemS.innerHTML = '<option value="">--</option>';
        if(sub) serviciosGlobal[emp]["Vehículo"][sub].forEach(s => itemS.innerHTML += `<option value="${s.nombre}" data-precio="${s.precio}">${s.nombre}</option>`);
    }

    function agregarServicioAMemoria() {
    // 1. Capturar elementos
    const itemS = document.getElementById('item_servicio');
    const cantInput = document.getElementById('cant_servicio');
    const descripcionInput = document.getElementById('descripcion_servicio');
    const contenedorDesc = document.getElementById('contenedor-descripcion'); // El div que aparece y desaparece

    // ==========================================
    // BLOQUEO TOTAL POR VISIBILIDAD
    // ==========================================
    // Si el contenedor de descripción está a la vista (display !== 'none')
    if (contenedorDesc && contenedorDesc.style.display !== 'none') {

        // Si el usuario no escribió nada
        if (descripcionInput.value.trim() === "") {

            // 1. Aviso visual
            descripcionInput.style.border = "2px solid red";
            descripcionInput.style.backgroundColor = "#fff0f0";
            descripcionInput.focus();

            // 2. Alerta al usuario
            alert("❌ BLOQUEO: La descripción es obligatoria para este servicio.");

            // 3. CORTAR EL VIAJE: No permite seguir a la suma ni al carrito
            return;
        }
    }

    // --- SI LLEGÓ AQUÍ, EL SERVICIO ES VÁLIDO O NO NECESITA DESCRIPCIÓN ---

    // Validaciones básicas de selección
    if(!itemS.value || itemS.value === "--") return alert("Por favor, seleccione un servicio.");
    const cant = parseFloat(cantInput.value);
    if(isNaN(cant) || cant <= 0) return alert("Ingrese una cantidad válida.");

    // Limpiamos estilos de error
    if(descripcionInput) {
        descripcionInput.style.border = "1px solid #ced4da";
        descripcionInput.style.backgroundColor = "#fff";
    }

    // Lógica de Precios (Tu código original)
    const opt = itemS.options[itemS.selectedIndex];
    let precioFinal = 0;
    if(opt.dataset.dinamico === "true") {
        const limite = parseFloat(opt.dataset.limite);
        const pBajo = parseFloat(opt.dataset.pbajo);
        const pAlto = parseFloat(opt.dataset.palto);
        precioFinal = (cant >= limite) ? pAlto : pBajo;
    } else {
        precioFinal = parseFloat(opt.dataset.precio) || 0;
    }

    // AGREGAR AL CARRITO
    carrito.push({
        tipo: 'Servicio',
        nombre: itemS.value,
        precio: precioFinal,
        cant: cant,
        total: precioFinal * cant,
        // Guardamos la descripción para el PDF
        descripcion_pdf: descripcionInput.value.trim()
    });

    // ACTUALIZAR RESUMEN
    renderLista();

    // LIMPIAR CAMPOS
    descripcionInput.value = "";
    if(contenedorDesc) contenedorDesc.style.display = 'none';
    cantInput.value = 1;

    console.log("Servicio agregado correctamente al resumen.");
}

    function agregarTransporte() {
        const sS = document.getElementById('trans_subruta');
        if(!sS.value) return;
        const emp = document.getElementById('empresa_selector').value;
        const zona = document.getElementById('trans_zona').value;
        const ruta = document.getElementById('trans_ruta').value;
        const precio = logisticaEmpresas[emp][zona][ruta][sS.value];
        carrito = carrito.filter(item => item.tipo !== 'Transporte');
        carrito.push({ tipo: 'Transporte', nombre: `Transporte: ${sS.value}`, precio, cant: 1, total: precio });
        renderLista();
    }

    function eliminarItem(index) {
        if(carrito[index].tipo === 'Extra') {
            const extra = extrasEspumas.find(e => e.nombre === carrito[index].nombre);
            if(extra) document.getElementById(extra.id).checked = false;
        }
        carrito.splice(index, 1);
        renderLista();
    }

    function toggleDescuento() {
        document.getElementById('contenedor_descuento_toggle').style.display = document.getElementById('aplicar_descuento').checked ? 'block' : 'none';
        renderLista();
    }

    function renderLista() {
        const emp = document.getElementById('empresa_selector').value;
        const moneda = (emp === "Pethelios") ? "$" : "C$";
        const listaV = document.getElementById('lista_visual');
        document.getElementById('badge-items').innerText = `${carrito.length} items`;

        if(carrito.length === 0) {
            listaV.innerHTML = '<div class="p-5 text-center text-muted"><p class="small mb-0">No hay servicios seleccionados</p></div>';
            document.getElementById('resumen_totales').innerHTML = "";
            return;
        }

        let subtotal = 0;
        listaV.innerHTML = "";
        carrito.forEach((item, index) => {
            subtotal += item.total;
            listaV.innerHTML += `
                <div class="item-servicio">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-link text-danger p-0 me-3" onclick="eliminarItem(${index})"><i class="fas fa-times-circle"></i></button>
                        <div><span class="fw-bold">${item.nombre}</span> ${item.cant > 1 ? `<span class="small text-muted">x${item.cant}</span>` : ''}</div>
                    </div>
                    <span class="fw-bold">${moneda} ${item.total.toLocaleString()}</span>
                </div>`;
        });

        const calc = calcularTotales(subtotal);
        document.getElementById('resumen_totales').innerHTML = `
            <div class="small">Subtotal: ${moneda} ${subtotal.toFixed(2)}</div>
            ${calc.ahorro > 0 ? `<div class="small text-danger">Ahorro: -${moneda} ${calc.ahorro.toFixed(2)}</div>` : ''}
            ${calc.iva > 0 ? `<div class="small">IVA (15%): ${moneda} ${calc.iva.toFixed(2)}</div>` : ''}
            <div class="h4 mt-2 fw-bold" style="color:var(--brand-color)">TOTAL: ${moneda} ${calc.total.toLocaleString()}</div>`;
    }

    function calcularTotales(subtotal) {
        let ahorro = 0;
        if(document.getElementById('aplicar_descuento').checked) {
            const val = parseFloat(document.getElementById('valor_descuento').value) || 0;
            ahorro = (document.getElementById('tipo_descuento').value === "porcentaje") ? (subtotal * (val/100)) : val;
        }
        const base = Math.max(0, subtotal - ahorro);
        const iva = document.getElementById('aplicar_iva').checked ? (base * 0.15) : 0;
        return { subtotal, ahorro, iva, total: base + iva };
    }

    function limpiarTodo() {
        carrito = [];
        document.getElementById('aplicar_descuento').checked = false;
        document.getElementById('aplicar_iva').checked = false;
        cambiarEmpresa();
    }

async function generarPDF() {
    if(carrito.length === 0) return alert("Agregue servicios para generar la cotización");

    const { jsPDF } = window.jspdf;

    // --- CAMBIO 1: ACTIVAR COMPRESIÓN ---
    const doc = new jsPDF({
        orientation: 'p',
        unit: 'mm',
        format: 'a4',
        compress: true // Esto comprime textos y vectores automáticamente
    });

    const emp = document.getElementById('empresa_selector').value;
    const moneda = (emp === "Pethelios") ? "$" : "C$";
    const brandColor = (emp === "Espumas") ? [0, 51, 153] : [159, 97, 49];

    // ==========================================================
    // CONEXIÓN CON FIREBASE PARA EL NÚMERO CORRELATIVO
    // ==========================================================
    const incluirCliente = document.getElementById('activar_cliente')?.checked;
    let numeroActual = 7560;

    if (incluirCliente) {
        try {
            const snapshot = await database.ref('contador_pdf').once('value');
            const valorNube = snapshot.val();
            if (valorNube !== null) {
                numeroActual = valorNube;
            } else {
                await database.ref('contador_pdf').set(7560);
            }
        } catch (error) {
            console.error("Error detallado:", error);
            alert("Fallo de conexión: " + error.message);
            return;
        }
    }

    // 1. PRIMERO DIBUJAMOS LA CABECERA (EL FONDO)
    doc.setFillColor(...brandColor);
    doc.rect(0, 0, 210, 45, 'F');

    // 2. AHORA DIBUJAMOS EL TEXTO ENCIMA DE LA CABECERA
    if (incluirCliente) {
        doc.setFontSize(14);
        doc.setTextColor(255, 255, 255);
        doc.setFont("helvetica", "bold");
        doc.text(`No. Proforma: ${numeroActual}`, 150, 25);
    }

    // --- LOGO OPTIMIZADO (CAMBIO 2) ---
   // --- LOGO OPTIMIZADO Y SIN FONDO NEGRO ---
    const img = document.getElementById('img-logo');
    try {
        // Dibujamos el cuadro blanco redondeado de fondo en el PDF
        doc.setFillColor(255, 255, 255);
        doc.roundedRect(45, 10, 25, 25, 2, 2, 'F');

        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = 200;
        canvas.height = 200;

        // --- SOLUCIÓN AL FONDO NEGRO: Pintar fondo blanco en el canvas ---
        ctx.fillStyle = "#FFFFFF";
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        // Dibujamos el logo encima del fondo blanco
        ctx.drawImage(img, 0, 0, 200, 200);

        // Convertimos a JPEG liviano (ahora el fondo será blanco, no negro)
        const imgData = canvas.toDataURL('image/jpeg', 0.7);

        doc.addImage(imgData, 'JPEG', 47, 12, 21, 21, undefined, 'FAST');
    } catch (e) {
        console.warn("Logo no disponible");
    }

    // --- RESTO DEL CÓDIGO (SIN CAMBIOS PARA NO BORRAR NADA) ---
    doc.setTextColor(255, 255, 255);
    doc.setFont("helvetica", "bold");
    doc.setFontSize(22);
    doc.text(emp.toUpperCase(), 75, 22);

    doc.setFontSize(9);
    doc.setFont("helvetica", "normal");
    const textoCabecera = incluirCliente ? "COTIZACIÓN DE SERVICIOS" : "PRESUPUESTO DE SERVICIOS";
    doc.text(textoCabecera, 75, 29);
    doc.text(`Fecha: ${new Date().toLocaleDateString()}`, 75, 34);

    let currentY = 55;

    // --- SECCIÓN DATOS DEL CLIENTE ---
    if (incluirCliente) {
        doc.setTextColor(brandColor[0], brandColor[1], brandColor[2]);
        doc.setFontSize(11);
        doc.setFont("helvetica", "bold");
        doc.text("DATOS DEL CLIENTE", 15, currentY);
        doc.setDrawColor(220);
        doc.line(15, currentY + 2, 195, currentY + 2);

        doc.setTextColor(80);
        doc.setFontSize(9);

        const nombreC = (document.getElementById('cliente_nombre') || document.getElementById('nombre_cliente'))?.value || "N/A";
        const cedulaC = (document.getElementById('cliente_cedula') || document.getElementById('cedula_cliente'))?.value || "N/A";
        const telC    = (document.getElementById('cliente_tel')    || document.getElementById('telefono_cliente'))?.value || "N/A";
        const direC   = (document.getElementById('cliente_direccion') || document.getElementById('direccion_cliente'))?.value || "N/A";

        doc.setFont("helvetica", "bold");  doc.text("Cliente:", 15, currentY + 10);
        doc.setFont("helvetica", "normal"); doc.text(nombreC, 40, currentY + 10);
        doc.setFont("helvetica", "bold");  doc.text("Cédula/RUC:", 115, currentY + 10);
        doc.setFont("helvetica", "normal"); doc.text(cedulaC, 145, currentY + 10);
        doc.setFont("helvetica", "bold");  doc.text("Teléfono:", 15, currentY + 16);
        doc.setFont("helvetica", "normal"); doc.text(telC, 40, currentY + 16);
        doc.setFont("helvetica", "bold");  doc.text("Dirección:", 115, currentY + 16);
        const direccionSplit = doc.splitTextToSize(direC, 50);
        doc.text(direccionSplit, 145, currentY + 16);

        currentY += 28;
    }

    // --- SECCIÓN LOGÍSTICA ---
    doc.setTextColor(brandColor[0], brandColor[1], brandColor[2]);
    doc.setFontSize(11);
    doc.setFont("helvetica", "bold");
    doc.text("DETALLES DE LOGÍSTICA Y ENTREGA", 15, currentY);
    doc.setDrawColor(220);
    doc.line(15, currentY + 2, 195, currentY + 2);

    doc.setTextColor(80);
    doc.setFontSize(9);
    doc.setFont("helvetica", "normal");
    const zona = document.getElementById('trans_zona')?.value || "No especificado";
    const ruta = document.getElementById('trans_ruta')?.value || "No especificado";
    const destino = document.getElementById('trans_subruta')?.value || "Recogida en sucursal";

    doc.text(`Zona: ${zona}`, 15, currentY + 8);
    doc.text(`Ruta: ${ruta}`, 75, currentY + 8);
    doc.text(`Destino Final: ${destino}`, 135, currentY + 8);

    // --- TABLA ---
    const rows = carrito.map(i => {
        let nombreMostrar = i.nombre;
        if (i.descripcion_pdf && i.descripcion_pdf !== "") nombreMostrar += `\nDetalle: ${i.descripcion_pdf}`;
        return [
            nombreMostrar,
            i.cant.toString(),
            `${moneda} ${i.precio.toLocaleString(undefined, {minimumFractionDigits: 2})}`,
            `${moneda} ${i.total.toLocaleString(undefined, {minimumFractionDigits: 2})}`
        ];
    });

    doc.autoTable({
        startY: currentY + 15,
        head: [['Descripción del Servicio / Producto', 'Cant.', 'Precio Unit.', 'Subtotal']],
        body: rows,
        theme: 'striped',
        headStyles: { fillColor: brandColor, textColor: 255, fontStyle: 'bold', halign: 'center' },
        margin: { left: 15, right: 15 },
        styles: { overflow: 'linebreak' }
    });

    // --- TOTALES Y PIE DE PÁGINA ---
    currentY = doc.lastAutoTable.finalY + 20;
    if (currentY > 260) { doc.addPage(); currentY = 30; }

    const sub = carrito.reduce((a, b) => a + b.total, 0);
    const calc = calcularTotales(sub);

    const drawTotalRow = (label, value, y, isTotal = false) => {
        if (isTotal) {
            doc.setFillColor(245, 245, 245);
            doc.rect(130, y - 6, 65, 10, 'F');
            doc.setFont("helvetica", "bold");
            doc.setFontSize(12);
            doc.setTextColor(...brandColor);
        } else {
            doc.setFont("helvetica", "normal");
            doc.setFontSize(10);
            doc.setTextColor(80);
        }
        doc.text(label, 135, y);
        doc.text(`${moneda} ${value.toLocaleString(undefined, {minimumFractionDigits: 2})}`, 195, y, { align: 'right' });
    };

    drawTotalRow("Subtotal:", calc.subtotal, currentY);
    currentY += 8;
    if (calc.ahorro > 0) {
        doc.setTextColor(180, 0, 0);
        drawTotalRow("Descuento aplicado:", -calc.ahorro, currentY);
        currentY += 8;
    }
    drawTotalRow("IVA (15%):", calc.iva, currentY);
    currentY += 15;
    drawTotalRow("TOTAL NETO:", calc.total, currentY, true);

    const notas = [
        "Nota: Oferta Válida por 30 días",
        "NOTA: Se solicita conexión a agua y energía para conectar equipo de limpieza"
    ];
    doc.setFontSize(8);
    doc.setTextColor(0);
    doc.text(notas[0], 105, 270, { align: 'center' });
    doc.text(notas[1], 105, 275, { align: 'center' });

    doc.setFontSize(7);
    doc.setTextColor(150);
    doc.text(`${emp} Nicaragua - Documento Generado Digitalmente`, 105, 290, { align: 'center' });

    // --- GUARDADO E INCREMENTO EN NUBE ---
    if (incluirCliente) {
        doc.save(`Proforma_${numeroActual}_${emp}.pdf`);
        await database.ref('contador_pdf').set(numeroActual + 1);
    } else {
        doc.save(`Presupuesto_${emp}_${new Date().getTime()}.pdf`);
    }



}    cambiarEmpresa();
</script>
<script>
function toggleCliente() {
    const check = document.getElementById('activar_cliente');
    const seccion = document.getElementById('seccion_cliente');

    // Usamos display block/none para que sea compatible con tu diseño actual
    seccion.style.display = check.checked ? 'block' : 'none';
}

// Validación básica para el teléfono mientras escriben
document.getElementById('cliente_tel')?.addEventListener('input', function (e) {
    let x = e.target.value.replace(/\D/g, '').match(/(\d{0,4})(\d{0,4})/);
    e.target.value = !x[2] ? x[1] : x[1] + '-' + x[2];
});
</script>
<script>
// ESTE CÓDIGO SOLO SE ENCARGA DE LA DESCRIPCIÓN DE SERVICIOS
document.addEventListener("DOMContentLoaded", function() {
    // 1. Identificamos el select de servicios (Servicio a Realizar)
    // Buscamos por el nombre que suele tener en estos sistemas
    const selectServicio = document.querySelector('select[name="servicio_realizar"]') ||
                           document.querySelector('select[id*="servicio"]');

    // 2. Identificamos el contenedor de descripción que pegaste en el HTML
    const contenedorDesc = document.getElementById('contenedor-descripcion');

    if (selectServicio && contenedorDesc) {
        selectServicio.addEventListener('change', function() {
            // Obtenemos el texto de la opción seleccionada
            const texto = this.options[this.selectedIndex].text.toLowerCase();

            // SI LA OPCIÓN TIENE LA PALABRA "ESPUMA" O "OTROS"
            if (texto.includes("espuma") || texto.includes("otros")) {
                contenedorDesc.style.display = 'block'; // Mostrar
            } else {
                contenedorDesc.style.display = 'none';  // Ocultar
            }
        });
    }
});
</script>
<script>
document.addEventListener("change", function(event) {
    // 1. Buscamos el selector de Categoría (el primer cuadro)
    // Usamos querySelector por si el ID cambia, buscamos el que dice "Categoría"
    const selectCat = document.querySelector('select[id*="categoria"]') || document.querySelector('select');
    const contenedor = document.getElementById('contenedor-descripcion');

    if (event.target === selectCat) {
        const opcionTexto = selectCat.options[selectCat.selectedIndex].text.toUpperCase();

        // 2. Si la categoría seleccionada es "OTROS" o "OTRO"
        if (opcionTexto.includes("OTRO")) {
            contenedor.style.display = 'block'; // Aparece arriba del botón
        } else {
            contenedor.style.display = 'none';  // Se oculta
            document.getElementById('descripcion_servicio').value = ''; // Limpia el texto
        }
    }
});
</script>
<script src="https://www.gstatic.com/firebasejs/10.8.0/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.8.0/firebase-database-compat.js"></script>

<script>
  const firebaseConfig = {
    apiKey: "AIzaSyDtiZmnAn7ct49IpEz2qsGVFQVB_YmL9hQ",
    authDomain: "proformaespumas.firebaseapp.com",
    databaseURL: "https://proformaespumas-default-rtdb.firebaseio.com",
    projectId: "proformaespumas",
    storageBucket: "proformaespumas.firebasestorage.app",
    messagingSenderId: "391176130544",
    appId: "1:391176130544:web:1575d4e007c7ed27789735"
  };

  // Esto inicializa Firebase correctamente
  if (!firebase.apps.length) {
      firebase.initializeApp(firebaseConfig);
  }
  const database = firebase.database();
</script>
</body>
</html>

