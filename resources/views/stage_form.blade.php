<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de Stage</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #34495e;
            font-weight: 500;
        }

        input[type="text"],
        input[type="email"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input:focus,
        textarea:focus {
            border-color: #3498db;
            outline: none;
        }

        button {
            background: #3498db;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 100%;
        }

        button:hover {
            background: #2980b9;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .errors-list {
            color: #dc3545;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>📄 Formulaire de Demande de Stage</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul class="errors-list">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('email') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Nom Complet :</label>
                <input type="text" id="name" name="name" required 
                    value="{{ old('name') }}"
                    placeholder="Votre nom complet">
            </div>

            <div class="form-group">
                <label for="email">Adresse Email :</label>
                <input type="email" id="email" name="email" required
                    value="{{ old('email') }}"
                    placeholder="exemple@domaine.com">
            </div>

            <div class="form-group">
                <label for="phone">Téléphone :</label>
                <input type="text" id="phone" name="phone" required
                    value="{{ old('phone') }}"
                    placeholder="06 12 34 56 78">
            </div>

            <div class="form-group">
                <label for="message">Message :</label>
                <textarea id="message" name="message" rows="5" required
                    placeholder="Décrivez votre demande...">{{ old('message') }}</textarea>
            </div>

            <div class="form-group">
                <label for="cv">CV (PDF uniquement) :</label>
                <input type="file" id="cv" name="cv" accept=".pdf" required>
            </div>

            <div class="form-group">
                <label for="motivation">Lettre de Motivation (PDF) :</label>
                <input type="file" id="motivation" name="motivation" accept=".pdf" required>
            </div>

            <button type="submit">📤 Envoyer la Demande</button>
        </form>
    </div>
</body>
</html>