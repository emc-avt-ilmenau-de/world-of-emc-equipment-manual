@extends('Frontend.layouts.main')
@section('main-container')

<main class="main-content">
    <div class="software-table">
        <!-- Category 1: EMCLED Flyers -->
        <h2>Category 1: EMCLED Flyers</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Language</th>
                    <th>Download Link</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Flyer AVT-EMCLED-024/040 V1.0</td>
                    <td>English</td>
                    <td>
                        <a href="https://www.avt-ilmenau.de/wp-content/uploads/2024/03/AVT_EMCLED024_40-Flyer_en_v1_00.pdf">Download EN Flyer</a>
                    </td>
                </tr>
                <tr>
                    <td>Flyer AVT-EMVLED-075 V1.05</td>
                    <td>German</td>
                    <td>
                        <a href="https://www.avt-ilmenau.de/wp-content/uploads/2024/03/AVT_EMCLED75-Flyer_de_v1_05.pdf">Download DE Flyer</a>
                    </td>
                </tr>
                <tr>
                    <td>Flyer AVT-EMVLED-100 V1.05</td>
                    <td>German</td>
                    <td>
                        <a href="https://www.avt-ilmenau.de/wp-content/uploads/2024/03/AVT_EMCLED100-Flyer_de_v1_05.pdf">Download DE Flyer</a>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Category 2: CamControl Flyers -->
        <h2>Category 2: CamControl Flyers</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Language</th>
                    <th>Download Link</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Flyer AVT-EMC CamControl V1.00</td>
                    <td>English</td>
                    <td>
                        <a href="https://www.avt-ilmenau.de/wp-content/uploads/2024/03/AVT_EMC_CamControl_Flyer_en_v.pdf">Download EN Flyer</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>

@endsection
