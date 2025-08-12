<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap ícones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <title>Lista de Filmes</title>
    <style>
        body {
            background-color: #860000ff;
            font-family: Arial, sans-serif;
            margin: 16px;
        }

        h1 {
            text-align: center;
            font-size: 60px;
            font-weight: bold;
            text-transform: uppercase;
            color: #fff;
        }

        /* container dos filmes */
        .lista-filmes {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            padding: 8px;
        }

                .custom-form {
            background: rgba(0, 0, 0, 0.36);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 255, 72, 0.51);
            margin-top: 30px;
            margin-bottom: 60px;
            max-width: 800px;   /* largura máxima menor */
            width: 100%;        /* ocupa até 100% do max-width */
            display: flex;
            flex-direction: column;
            gap: 15px;          /* espaçamento entre campos */
            align-items: center; /* centraliza itens horizontalmente */
        }

        .custom-form .col-sm-6 {
            margin-top: 5px !important;
            margin-bottom: 5px !important;
        }


        .custom-input {
            background: rgba(255, 255, 255, 0.73);
            border: 1px solid rgba(0, 255, 153, 0.5);
            color: #fff;
            box-shadow:
                0 0 5px #fff,
                0 0 5px #025e00ff,
                0 0 5px #025e00ff,
                0 0 5px #025e00ff;

        }

        .custom-input:focus {
            background: rgba(255, 255, 255, 0.6);
            border-color: #007e4cff;
            box-shadow: 0 0 10px #005835ff;
            color: #025e00ff;
        }


        /* card filme */
        .filme {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            border: 1px solid #ddd;
            padding: 12px;
            flex: 0 0 480px;
            max-width: 100%;
            background: #fff;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .filme img {
            width: 120px;
            height: 180px;
            object-fit: cover;
            border-radius: 4px;
        }

        .detalhes {
            flex: 1;
            text-align: left;
        }

        /* container das ações dentro do card */
        .actions {
            margin-top: 8px;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        /* formulário adicionar */
        .form-add {
            margin-bottom: 20px;
            border: 1px solid #ccccccff;
            padding: 15px;
            background: #f8f8f8b3;
            border-radius: 5px;
            
        }

        .form-add input[type="text"],
        .form-add textarea,
        .form-add input[type="file"] {
            display: block;
            margin-top: 5px;
            margin-bottom: 10px;
            padding: 8px;
            width: 100%;
            font-size: 1rem;
        }

        #editModal {
            display: none; /* escondido por padrão */
            position: fixed;
            z-index: 1050;
            top: 0;
            left: 0;
            width: 100vw; /* ocupa a tela inteira */
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);

            justify-content: center;
            align-items: center;
        }

        #editModal.show {
            display: flex; /* exibido quando tiver a classe 'show' */
        }

        #editModal .modal-content {
            background: white;
            border-radius: 8px;
            padding: 20px;
            max-width: 400px;
            width: 90vw;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
        }

        /* botões cursor */
        button {
            cursor: pointer;
        }

        .btn-success {
            background-color: #ff0000ff;
            border: none;
            font-weight: bold;
            transition: 0.3s;
        }


        /* responsividade */
        @media (max-width: 540px) {
            .filme {
                flex-direction: row;
                flex: 0 0 100%;
            }

            .filme img {
                width: 90px;
                height: 135px;
            }
        }
    </style>
</head>
<body>
    <h1 class="mb-4">Filmes assistidos</h1>

    {{-- Mensagens --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulário --}}
    <form action="{{ route('filmes.store') }}" method="POST" enctype="multipart/form-data" class="form-add">
        @csrf
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" required />

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao"></textarea>

        <label for="imagem">Imagem:</label>
        <input type="file" name="imagem" id="imagem" accept="image/*" />

        <button type="submit" class="btn btn-success btn-sm">Adicionar Filme</button>
    </form>

    {{-- Lista de filmes --}}
    <div class="lista-filmes">
        @foreach($filmes as $f)
            <div class="filme">
                <img
                    src="{{ $f->imagem ? asset('storage/' . $f->imagem) : 'https://via.placeholder.com/120x180?text=Sem+Imagem' }}"
                    alt="{{ $f->titulo }}"
                />
                <div class="detalhes">
                    <h2>{{ $f->titulo }}</h2>
                    <p>{{ $f->descricao }}</p>

                    <button
                        onclick="abrirModal({{ $f->id }}, '{{ addslashes($f->titulo) }}', '{{ addslashes($f->descricao) }}')"
                        class="btn btn-primary btn-sm"
                    >
                        Editar
                    </button>

                    <form action="{{ route('filmes.destroy', $f) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            onclick="return confirm('Tem certeza que deseja excluir?')"
                            class="btn btn-danger btn-sm"
                        >
                            Excluir
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Modal de edição --}}
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fecharModal()">&times;</span>
            <h3>Editar Filme</h3>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label for="editTitulo">Título:</label>
                <input type="text" name="titulo" id="editTitulo" required />

                <label for="editDescricao">Descrição:</label>
                <textarea name="descricao" id="editDescricao"></textarea>

                <label for="editImagem">Imagem:</label>
                <input type="file" name="imagem" id="editImagem" accept="image/*" />

                <button type="submit" class="btn btn-success btn-sm">Salvar Alterações</button>
            </form>
        </div>
    </div>

    <script>
        function abrirModal(id, titulo, descricao) {
            document.getElementById('editTitulo').value = titulo;
            document.getElementById('editDescricao').value = descricao;
            document.getElementById('editForm').action = '/filmes/' + id;
            document.getElementById('editModal').classList.add('show');
        }

        function fecharModal() {
            document.getElementById('editModal').classList.remove('show');
        }

        window.onclick = function (event) {
            const modal = document.getElementById('editModal');
            if (event.target === modal) {
                fecharModal();
            }
        };
    </script>
</body>
</html>
