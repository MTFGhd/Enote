<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Séances validées - {{ $dateDebut }} au {{ $dateFin }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10pt;
            margin: 20px;
        }
        h1 {
            text-align: center;
            color: #1e40af;
            margin-bottom: 10px;
        }
        .periode {
            text-align: center;
            color: #6b7280;
            margin-bottom: 20px;
            font-size: 11pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #1e40af;
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 9pt;
        }
        td {
            border: 1px solid #e5e7eb;
            padding: 6px;
            font-size: 9pt;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .type-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 8pt;
            font-weight: bold;
        }
        .type-C {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .type-T {
            background-color: #e9d5ff;
            color: #7c3aed;
        }
        .type-E {
            background-color: #fef3c7;
            color: #d97706;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 8pt;
            color: #9ca3af;
        }
        .total {
            font-weight: bold;
            background-color: #f3f4f6;
        }
    </style>
</head>
<body>
    <h1>Rapport des séances validées</h1>
    <div class="periode">
        Période : du {{ \Carbon\Carbon::parse($dateDebut)->format('d/m/Y') }} 
        au {{ \Carbon\Carbon::parse($dateFin)->format('d/m/Y') }}
    </div>

    @if($cours->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 12%;">Date</th>
                    <th style="width: 10%;">Horaire</th>
                    <th style="width: 18%;">Enseignant</th>
                    <th style="width: 15%;">Classe</th>
                    <th style="width: 18%;">Matière</th>
                    <th style="width: 10%;">Type</th>
                    <th style="width: 7%;">Durée</th>
                    <th style="width: 10%;">Absents</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $typeLabels = ['C' => 'Cours', 'T' => 'TP', 'E' => 'Examen'];
                    $totalDuree = 0;
                @endphp
                @foreach($cours as $seance)
                    @php
                        $totalDuree += $seance->Duree;
                    @endphp
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($seance->Jour)->format('d/m/Y') }}</td>
                        <td>{{ $seance->HeureDebut }}-{{ $seance->HeureFin }}</td>
                        <td>{{ $seance->enseignant?->Libelle ?? $seance->CodeE }}</td>
                        <td>{{ $seance->classe?->Libelle ?? $seance->CodeC }}</td>
                        <td>{{ $seance->matiere?->Libelle ?? $seance->CodeM }}</td>
                        <td>
                            <span class="type-badge type-{{ $seance->Type }}">
                                {{ $typeLabels[$seance->Type] ?? $seance->Type }}
                            </span>
                        </td>
                        <td style="text-align: center;">{{ $seance->Duree }}h</td>
                        <td style="text-align: center;">{{ $seance->NbAbsent ?? 0 }}</td>
                    </tr>
                @endforeach
                <tr class="total">
                    <td colspan="6" style="text-align: right;">Total</td>
                    <td style="text-align: center;">{{ $totalDuree }}h</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            Nombre total de séances validées : {{ $cours->count() }} | 
            Durée totale : {{ $totalDuree }} heures | 
            Généré le {{ now()->format('d/m/Y à H:i') }}
        </div>
    @else
        <p style="text-align: center; color: #9ca3af; margin-top: 40px;">
            Aucune séance validée trouvée pour cette période.
        </p>
    @endif
</body>
</html>
