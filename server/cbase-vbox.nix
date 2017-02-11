let
  cbase =
    { config, pkgs, ... }:
    { deployment.targetEnv = "virtualbox";
      deployment.virtualbox = {
        memorySize = 1024;
        headless = true;
      };

      virtualisation.virtualbox.guest.enable = true;

      # shared folders
      # http://nixos.org/nixops/manual/#opt-deployment.virtualbox.sharedFolders
      # Note: the shared folder 'key' is equal the 'device' in fileSystems in the following declaration
      deployment.virtualbox.sharedFolders = {
        cbase = {
          hostPath = "/Users/hschaeidt/Projects/github/hschaeidt/cbase";
          readOnly = false;
        };
      };

      fileSystems."/var/www/cbase" = {
        device = "cbase";
        fsType = "vboxsf";
        options = [ "uid=33" "gid=33" ];
      };
    };
in
{ 
    network.enableRollback = true;
    inherit cbase;
}