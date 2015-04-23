(function() {
  'use strict';
  angular.module('poxy').controller('MainCtrl', function($scope) {
    $scope.awesomeThings = ['HTML5 Boilerplate', 'AngularJS', 'Karma'];
    $scope["class"] = 'ppaxyd_v100ppaxye_v100';
    $scope.container = 'red';
    $scope.activeMenuHide = 'show';
    $scope.activeMenuShow = 'hide';
    $scope.changeClass = function() {
      if ($scope["class"] === 'ppaxyd_v100ppaxye_v100') {
        $scope["class"] = 'paxyd_v100paxye_v100 ofyt';
        $scope.container = 'd_v100e_v100 ofh';
        $scope.activeMenuHide = 'hide';
        $scope.activeMenuShow = 'show';
      } else {
        $scope["class"] = 'ppaxyd_v100ppaxye_v100';
        $scope.container = 'blue';
        $scope.activeMenuHide = 'show';
        $scope.activeMenuShow = 'hide';
      }
    };
    return;
    $scope.layout = "light";
    $scope.layouts = [
      {
        name: "Light",
        url: "light"
      }, {
        name: "Dark",
        url: "dark"
      }, {
        name: "Flat",
        url: "flat"
      }, {
        name: "3D",
        url: "3d"
      }
    ];
    $scope.clientgrid = "___a16a_16b16b_16c14c_14d14d_14e12e_12";
    $scope.clientgrids = [
      {
        name: "Two",
        size: "___a12a_12b12b_12c12c_12d12d_12e12e_12"
      }, {
        name: "Three",
        size: "___a13a_13b13b_13c14c_14d14d_14e12e_12"
      }, {
        name: "Four",
        size: "___a14a_14b14b_14c14c_14d14d_14e12e_12"
      }, {
        name: "Five",
        size: "___a15a_15b15b_15c14c_14d14d_14e12e_12"
      }, {
        name: "Six",
        size: "___a16a_16b16b_16c14c_14d14d_14e12e_12"
      }, {
        name: "Eight",
        size: "___a18a_18b18b_18c16c_16d14d_14e12e_12"
      }, {
        name: "Ten",
        size: "___a110a_110b110b_110c18c_18d14d_14e12e_12"
      }
    ];
    $scope.workgrid = "___a14a_13b14b_13c14c_13d14d_13e12e_12";
    $scope.workgrids = [
      {
        name: "Two",
        size: "___a12a_35b12b_35c12c_35d12d_35e12e_35"
      }, {
        name: "Three",
        size: "___a13a_25b13b_25c14c_14d14d_14e12e_12"
      }, {
        name: "Four",
        size: "___a14a_13b14b_13c14c_13d14d_13e12e_12"
      }, {
        name: "Five",
        size: "___a15a_15b15b_15c14c_14d14d_14e12e_12"
      }, {
        name: "Six",
        size: "___a16a_16b16b_16c14c_14d14d_14e12e_12"
      }, {
        name: "Eight",
        size: "___a18a_18b18b_18c16c_16d14d_14e12e_12"
      }, {
        name: "Ten",
        size: "___a110a_110b110b_110c18c_18d14d_14e12e_12"
      }
    ];
  });

}).call(this);

/*
//@ sourceMappingURL=main.js.map
*/