with import <nixpkgs> {};
stdenv.mkDerivation {
  name = "cbase";
  src = ./.;

  buildInputs = [
    php
    phpPackages.composer
  ];

  buildPhase = ''
    composer install
  '';

  installPhase = ''
    mkdir -p $out/share
    cp -r . $out/share/cbase
  '';
}