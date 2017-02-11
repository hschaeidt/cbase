{
  network.description = "mtg card database";

  cbase = { config, pkgs, ... }:
  let
    pkg = import ../default.nix;
    fcgiSocket = "/run/phpfpm/nginx";
    projectName = "cbase";
    realPathRoot = "/var/www/cbase";
    runUser = "www-data";
    runGroup = "www-data";
  in
  {
    networking.firewall.allowedTCPPorts = [ 80 443 ];

    environment.systemPackages = [
      pkgs.ag
      pkgs.vim
      pkgs.phpPackages.composer
    ];

    services.phpfpm.poolConfigs.nginx = ''
      listen = ${fcgiSocket}
      listen.owner = ${runUser}
      listen.group = ${runGroup}
      listen.mode = 0660
      user = ${runUser}
      pm = dynamic
      pm.max_children = 75
      pm.start_servers = 10
      pm.min_spare_servers = 5
      pm.max_spare_servers = 20
      pm.max_requests = 500
    '';

    services.nginx = {
      enable = true;
      recommendedOptimisation = true;
      recommendedTlsSettings = true;
      recommendedGzipSettings = true;
      recommendedProxySettings = true;
      user = "${runUser}";
      group = "${runGroup}";
      virtualHosts."localhost" = {
        extraConfig = ''
          root ${realPathRoot}/web;

          location / {
            # try to serve file directly, fallback to app.php
            try_files $uri /app.php$is_args$args;
          }

          # DEV
          # This rule should only be placed on your development environment
          # In production, don't include this and don't deploy app_dev.php or config.php
          location ~ ^/(app_dev|config)\.php(/|$) {
            fastcgi_pass phpfcgi; # this links to the defined upstream in 'appendHttpConfig'
            fastcgi_split_path_info ^(.+\.php)(/.*)$;
            include ${pkgs.nginx}/conf/fastcgi_params;
            # When you are using symlinks to link the document root to the
            # current version of your application, you should pass the real
            # application path instead of the path to the symlink to PHP
            # FPM.
            # Otherwise, PHP's OPcache may not properly detect changes to
            # your PHP files (see https://github.com/zendtech/ZendOptimizerPlus/issues/126
            # for more information).
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_param DOCUMENT_ROOT $document_root;
          }
          
          # PROD
          location ~ ^/app\.php(/|$) {
            fastcgi_pass phpfcgi; # this links to the defined upstream in 'appendHttpConfig'
            fastcgi_split_path_info ^(.+\.php)(/.*)$;
            include ${pkgs.nginx}/conf/fastcgi_params;
            # When you are using symlinks to link the document root to the
            # current version of your application, you should pass the real
            # application path instead of the path to the symlink to PHP
            # FPM.
            # Otherwise, PHP's OPcache may not properly detect changes to
            # your PHP files (see https://github.com/zendtech/ZendOptimizerPlus/issues/126
            # for more information).
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            fastcgi_param DOCUMENT_ROOT $document_root;
            # Prevents URIs that include the front controller. This will 404:
            # http://domain.tld/app.php/some-path
            # Remove the internal directive to allow URIs like this
            internal;
          }

          # return 404 for all other php files not matching the front controller
          # this prevents access to other php files you don't want to be accessible.
          location ~ \.php$ {
            return 404;
          }
        '';
      };
      appendHttpConfig = ''
        upstream phpfcgi {
            server unix:${fcgiSocket};
        }
      '';
    };

    services.mysql = {
      enable = true;
      package = pkgs.mysql;
      initialDatabases = [ { name = "cbase"; schema = ./cbase.sql; } ];
    };

    users.extraUsers."${runUser}" = {
      uid = 33;
      group = "${runGroup}";
      home = "/var/www";
      createHome = true;
      useDefaultShell = true;
    };
    users.extraGroups."${runUser}".gid = 33;
  };
}
