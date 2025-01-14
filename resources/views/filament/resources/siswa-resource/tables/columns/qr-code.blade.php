@php
    $qrCode = \BaconQrCode\Renderer\ImageRenderer::class;
    $renderer = new \BaconQrCode\Renderer\ImageRenderer(
        new \BaconQrCode\Renderer\RendererStyle\RendererStyle(150),
        new \BaconQrCode\Renderer\Image\SvgImageBackEnd()
    );
    $writer = new \BaconQrCode\Writer($renderer);
    $qrCodeSvg = $writer->writeString($getRecord()->nis);
@endphp

<div class="flex flex-col items-center space-y-2">
    <div class="w-32 h-32">
        {!! $qrCodeSvg !!}
    </div>
    <p class="text-xs text-gray-500">{{ $getRecord()->nis }}</p>
</div>
