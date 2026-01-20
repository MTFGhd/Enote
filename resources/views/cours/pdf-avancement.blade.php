<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapport d'avancement</title>
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
        .filters {
            text-align: center;
            color: #6b7280;
            margin-bottom: 20px;
            font-size: 10pt;
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
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 8pt;
            color: #9ca3af;
        }
        .no-data {
            text-align: center;
            color: #9ca3af;
            margin-top: 40px;
        }
        .progress-bar {
            background-color: #e5e7eb;
            height: 12px;
            border-radius: 4px;
            overflow: hidden;
        }
        .progress-fill {
            background-color: #10b981;
            height: 100%;
        }
    </style>
</head>
<body>
    <h1>Rapport d'avancement par Formateur / Groupe / Module</h1>
    
    @php
        $filterText = [];
        if (!empty($filters['code_e'])) {
            $ens = \App\Models\Enseignants::find($filters['code_e']);
            $filterText[] = 'Formateur: ' . ($ens ? $ens->Libelle : $filters['code_e']);
        }
        if (!empty($filters['code_c'])) {
            $cls = \App\Models\Classes::find($filters['code_c']);
            $filterText[] = 'Groupe: ' . ($cls ? $cls->Libelle : $filters['code_c']);
        }
        if (!empty($filters['code_m'])) {
            $mat = \App\Models\Matieres::find($filters['code_m']);
            $filterText[] = 'Module: ' . ($mat ? $mat->Libelle : $filters['code_m']);
        }
    @endphp
    
    <div class="filters">
        @if(count($filterText) > 0)
            Filtres appliqués : {{ implode(' | ', $filterText) }}
        @else
            Tous les avancements
        @endif
    </div>

    @if($avancements->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 20%;">Formateur</th>
                    <th style="width: 20%;">Groupe</th>
                    <th style="width: 25%;">Module</th>
                    <th style="width: 15%;">MH Prévues</th>
                    <th style="width: 15%;">MH Réalisées</th>
                    <th style="width: 5%;">%</th>
                </tr>
            </thead>
            <tbody>
                @foreach($avancements as $avancement)
                    @php
                        $mhPrevues = $avancement->matiere?->MH ?? 0;
                        $mhRealisees = $avancement->MHRealise ?? 0;
                        $pourcentage = $mhPrevues > 0 ? round(($mhRealisees / $mhPrevues) * 100, 1) : 0;
                    @endphp
                    <tr>
                        <td>{{ $avancement->enseignant?->Libelle ?? $avancement->CodeE }}</td>
                        <td>{{ $avancement->classe?->Libelle ?? $avancement->CodeC }}</td>
                        <td>{{ $avancement->matiere?->Libelle ?? $avancement->CodeM }}</td>
                        <td style="text-align: center;">{{ $mhPrevues }}h</td>
                        <td style="text-align: center;">{{ $mhRealisees }}h</td>
                        <td style="text-align: center;">{{ $pourcentage }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            Nombre total d'avancements : {{ $avancements->count() }} | 
            Généré le {{ now()->format('d/m/Y à H:i') }}
        </div>
    @else
        <p class="no-data">
            Aucun avancement trouvé avec les critères sélectionnés.
        </p>
    @endif
</body>
</html>
