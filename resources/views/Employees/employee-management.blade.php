@extends('layouts.app')

@section('title', 'Funcionários - Gerenciamento completo.')

@section('content')
    <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">

                            <!-- Coluna do título -->
                            <div class="col-md-6 col-12 title-format">
                                <h5 class="mb-0">Funcionários</h5>
                                <p class="text-sm mb-0">
                                    <span class="font-weight-bold">Gerenciamento</span> completo
                                </p>
                            </div>

                            <!-- Coluna dos botões -->
                            <div class="col-md-6 col-12 d-flex justify-content-center justify-content-lg-end gap-2 mt-2 mt-md-0">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new-block"><i class="fa-solid fa-user-plus icon-format"></i> Novo funcionário</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2 first-item">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nome</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Setor</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ajustes</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $employee)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $employee->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $employee->sector }}</h6>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                <a href="{{ route('funcionarios.show', $employee->id) }}"><i class="fa-solid fa-user-pen cursor-pointer maintence-icon"></i></a>
                                                <i class="fa-solid fa-trash cursor-pointer text-danger" id="delete{{$employee->id}}"></i>
                                            </td>
                                        </tr>

                                        <form id="form-delete-{{ $employee->id }}" action="{{ route('funcionarios.destroy', $employee->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <script>
                                            const btnAlert{{ $employee->id }} = document.querySelector('#delete{{ $employee->id }}');
                                            btnAlert{{ $employee->id }}.addEventListener('click', function () {
                                                Swal.fire({
                                                    html: `Deseja excluir o usuário <b>{{ $employee->name }}</b>?`,
                                                    icon: "question",
                                                    showCancelButton: true,
                                                    cancelButtonText: 'Voltar',
                                                    confirmButtonText: 'Excluir',
                                                    confirmButtonColor: '#F97316',
                                                    focusCancel: true
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        document.getElementById('form-delete-{{ $employee->id }}').submit();
                                                    }
                                                });
                                            });
                                        </script>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de blocos-->
    <div class="modal fade" id="new-block" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cadastrar funcionário</h5>
                    <i class="fa-solid fa-circle-xmark text-danger ms-auto cursor-pointer" data-bs-dismiss="modal"></i>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('funcionarios.store') }}" method="post" id="user-form">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <span class="font-weight-bold modal-label">Nome:</span>
                                    <input type="text" id="name" name="name" placeholder="Nome e sobrenome" class="form-control input-format mt-2">
                                </div>

                                <div class="col-12 mt-3">
                                    <span class="font-weight-bold modal-label">Setor:</span>
                                    <select name="sector" id="sector" class="form-control input-format mt-2">
                                        <option value="selecione" disabled selected>Selecione</option>
                                        <option value="Área Técnica">Área Técnica</option>
                                        <option value="Gestão">Gestão</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer format-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="register">
                        <span class="button-text"><i class="fa-solid fa-circle-check icon-format"></i> Cadastrar</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>


    @if(session('msg-success'))
        <script>
            const notyf = new Notyf({
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            notyf
                .success({
                    message: '{{ session('msg-success') }}',
                    dismissible: true,
                    duration: 5000
                });
        </script>
    @endif

    @if(session('msg-error'))
        <script>
            const notyf = new Notyf({
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            notyf
                .error({
                    message: '{{ session('msg-error') }}',
                    dismissible: true,
                    duration: 5000
                })
        </script>
    @endif

    @if ($errors->any())
        <script>
            const notyf = new Notyf({
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            notyf
                .error({
                    message: '{{ $errors->first() }}',
                    dismissible: true,
                    duration: 5000
                })
        </script>
    @endif

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsivity.css') }}">
    <script src="{{ asset('assets/js/resources/new-employee.js') }}"></script>
@endsection
