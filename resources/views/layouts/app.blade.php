<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Band Finder') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #f3f4f6;
            color: #1f2937; /* testo normale nero */
            font-family: 'Inter', sans-serif;

            /* Flex layout per footer sticky */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        header {
            background-color: #6d28d9; /* viola */
            color: #facc15; /* titolo header giallo */
        }

        header a {
            color: #facc15; /* link giallo */
            font-weight: 600;
            margin-left: 1rem;
            transition: color 0.3s ease;
            text-decoration: none;
        }

        header a:hover {
            color: #fde68a; /* giallo chiaro hover */
            text-decoration: underline;
        }

        footer {
            background-color: #10b981; /* verde acceso */
            color: #facc15; /* testo footer giallo */
            text-align: center;
            padding: 1rem 2rem;
            font-weight: 600;
            margin-top: auto; /* Spinge il footer in basso */
        }

        main.container {
            max-width: 960px;
            margin: 2rem auto;
            padding: 0 1rem;
            flex-grow: 1; /* fa crescere main per occupare lo spazio */
        }

        .bg-accent {
            background-color: #ede9fe; /* sfondo viola chiaro */
        }

        .card {
            background-color: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 1rem 1.25rem;
            box-shadow: 0 2px 4px rgb(0 0 0 / 0.05);
            color: #1f2937; /* testo normale nero */
        }

        /* Bottoni */
        .btn {
            font-weight: 600;
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            display: inline-block;
            text-align: center;
            text-decoration: none;
            color: #facc15; /* testo bottone giallo */
        }

        .btn-primary {
            background-color: #a78bfa; /* viola chiaro */
            border: 1px solid #7c3aed; /* viola più scuro */
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: #7c3aed;
            color: #fde68a; /* giallo chiaro hover */
            box-shadow: 0 4px 10px rgba(124, 58, 237, 0.4);
            outline: none;
        }

        .btn-secondary {
            background-color: #10b981; /* verde acceso */
            border: 1px solid #059669;
        }

        .btn-secondary:hover,
        .btn-secondary:focus {
            background-color: #059669;
            color: #fde68a; /* giallo chiaro hover */
            box-shadow: 0 4px 10px rgba(5, 150, 105, 0.4);
            outline: none;
        }

        /* Link come bottoni */
        .btn-link {
            background: none;
            color: #facc15; /* link bottone giallo */
            padding: 0;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: underline;
            font-size: 1rem;
        }

        .btn-link:hover,
        .btn-link:focus {
            color: #fde68a; /* giallo chiaro hover */
            outline: none;
        }

        /* Form inputs */
        input[type="text"],
        select,
        textarea {
            background-color: #1f2937;
            color: #f9fafb;
            border: 1px solid #4b5563;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            width: 100%;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="text"]:focus,
        select:focus,
        textarea:focus {
            border-color: #7c3aed;
            box-shadow: 0 0 5px 2px rgba(124, 58, 237, 0.5);
            outline: none;
            color: #f9fafb;
        }

        /* Error messages */
        .text-error {
            color: #f87171; /* rosso chiaro */
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Headings */
        h1,
        h2,
        h3 {
            color: #facc15; /* titoli gialli */
        }

        /* Utility */
        .space-y-4 > * + * {
            margin-top: 1rem;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>

    <header>
        <div class="container flex justify-between items-center mx-auto max-w-5xl">
            <h1 class="text-2xl font-bold">Band Finder</h1>
            <nav>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('bands.index') }}">I tuoi gruppi</a>
                <a href="{{ route('bands.explore') }}">Esplora</a>
                <a href="{{ route('profile.edit') }}">Profilo</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn-link">Logout</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="container">
        @if(session('success'))
            <div class="card mb-4" style="background-color:#dcfce7; color:#166534; border-color:#bbf7d0;">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        © {{ date('Y') }} Band Finder. Tutti i diritti riservati.
    </footer>

</body>

</html>
