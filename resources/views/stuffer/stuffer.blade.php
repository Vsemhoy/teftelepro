@extends('bootstrap.default')

@section('page-content')

    <?php
    use App\Http\Controllers\Controller;
    // $instant  = new Controller();
    // echo $instant->renderValue();

    // $results = DB::select('select * from splmod_users where id < ?', [10]);
    // foreach($results AS $key => $value){
    //     print_r($value);
    //     echo "<br>";
    // }

    ?>



<div class="order-1 bg-white">
  <div class="container">
      <div class="bd-intro pt-2 ps-lg-2 ">
        <div class="d-md-flex flex-md-row-reverse align-items-center justify-content-between">
          <a class="btn btn-sm btn-bd-light mb-3 mb-md-0 rounded-2" href="https://github.com/twbs/bootstrap/blob/main/site/content/docs/5.2/customize/components.md" title="View and edit this file on GitHub" target="_blank" rel="noopener">
            View on GitHub
          </a>
          <h1 class="bd-title mb-0" id="content">Stuff manager</h1>
        </div>
        <p class="bd-lead">Learn how and why we build nearly all our components responsively and with base and modifier classes.</p>
      </div>


      <div class="row">
        <div class="col-md-9 p-4">
          <div class="card-collection row" style="">
            <?php
            for ($i = 0 ; $i < 10; $i++):
              ?>
            <div class="d-flex  mt-3">
              <?php if ($i < 5): ?>
              <div class="flex-shrink-0">
                <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxASEBUQEBEWEhAVFRAVFRAQEBUQEBAVFxUYGRYVFRUYHSggGBolGxUVITEhKCkrLi4uFx82ODMsNygtLisBCgoKDg0OGxAQGy0mHyUtMC4vLS43LS0rLzUtLysrMDctLS0tLS0tLy0tLy4tLS0tLS0tKy0wLS0tLS0tKy0tLf/AABEIAMIBAwMBIgACEQEDEQH/xAAcAAEAAQUBAQAAAAAAAAAAAAAAAwIEBQYHAQj/xABDEAACAQIDAwoCBAwGAwAAAAABAgADEQQSIQUxUQYHEyJBYXGBkaEykhRigrEjM0JDUnKissHC0fEkY5Oz0uEVU6P/xAAaAQEAAgMBAAAAAAAAAAAAAAAAAQQCAwUG/8QAMREAAgEDAgMGBAYDAAAAAAAAAAECAxEhBDESQVEFYYGRwfATcaHhIiMysdHxBhRD/9oADAMBAAIRAxEAPwDuMREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBESxx21sNQF6+IpUgN5q1UpgfMRAL6JqWM5ydjUvix1Nu6iHxH+2GmCxvPVsxPxdPEVu9KSov/0ZT7RYHSonFsZz6ndQwAt2NWxNj5qqH96YOvzw7WqnLSShT0JAp0HqOABcnrOQbAE3tuElJvYH0LE+Y9octttuoatjK6I5YKURcMCVClgrU1U6B17e0Tp/M1t7F16dSjiajVggV0q1CXqAMSMrOdW3Ei+uh14S4tbg6bERMQIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgGjc53LSps6nSp4dFqYvEMwphwSqqtszFQQWN2UAXG8nsseWbV5Y8obkVsT9GW17BaFO3hYF/eZTnAxNXF7eKUVLjCUkpgILnM65mKj9L8La3+X3TV+U9aj0pWojUqq6MEs5bTUOWbqtmzbr9XLoJ0NLp6UknUUm3e1trK27y8vCS3tuWqK0/A3NtyvsrJWst8Xzn1aMFj+UGMqaVsZiKt73V8TVZfQtbymKRxvCgSOq2Yz1Fm//VpJ7FbeWNibpDKlbiZGCNwlQpzZGlBbJG6K5orY38J7RqMpuhKmxF1YqbMCGFx2EEg9xnqG+gmQ2fs0tqRNypueImyFKVV8MCJ6tSoQGdnN7DOxaxJ7L8dJ37md2cKeFqVbWLuqeK010t5u3vOI4TCj6XkA0S5P2Vv+8QJ9I8h8CKGz6CDtQ1DffeqxqG/zzj6l/mS+dvLBXqq1RxfLHoZ6IiVjAREQBERAEREAREQBERAEREAREQBERAEREAREQBIcTXWmjVHNkRWZjwVRcn0Emmkc8W1vo+yK9jZq2XDr39J8Y/0xUPlDdgca5N/ScXiMRiENRKtd3bNSy3Bqs90znVQAzXtawXXsl5yk2ds2miUEHTYhc2aolTqAm187DV2Fu62uguBNYpVXpsVGfq0lJyE5VOt2IHbmJsdLEiZHA4U2AIu5F7DXwY8B/fx95o9HGFGNKptG10ubtd36pN4X9FWjSVar8SUrRxs7fW/S7d9lfubwdfYrXJo6jflY6+vDxmKFx3TdMWStz4Ad3/ctdm4cUzWK0VqirQq0lzaCgzgA1FFtWCg2/WM0doaKMUp0V4L06HWnpXOzpL29rGrqe6X1LD1G3KZntk7BVbM9ydCE/rM5RZb9GFUHcchv36+kr0tFK15u1zqaTsaco3qy4b7Lma/srY1yMwm04bDIgAt1R/WVBwNBIdsVsuGqN2lQo49dsv8AGXOGGnpuS5Jvyyd6jp6GjpSks2TbfyyYPk5hTXZ+xq9WjQvwatUu3ppPqGmgACgWAAAHADdOE81Wzs+Lwi20X6TimHco6JP2ip/vO8zxEm3l7ngLt5luIiJiSIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAnGefHG9LisFgVOgLYioOOpVf2UrfMJ2acCr4lMVtzG4uq3+HonoV4EJ1LL4mm5+33yxpIKdaMX1/bP1tYr6qo6dGUlvbHzeF9WYraOwkRGxdUslIgdTOUWswvYGW+ztrmsztTw4SmB+bZVNtwS5Qt32DD3l3tnFHaWJWl+KwyGwtuUDefSe49KNFclAHINSALan7zunu1F/wDT9Ty+7595u/x/suOoi6moleMcW57Jrljlz4rJLkQ4PCCuWzEgg0wCNVXMSSTfU2RXN/qzPYbYtIMqqGIOSyhhmGannJvls3hYaka8cHsIWNzVKG4bRM2c2YajgAxFjocxmSfHlL2r1C9w2UA2ZgxNyb/pGV6s5OTt693d6370ero05QvLKv3PG3O3nm/Rq5Nt6giZVp6qwI6rHLUYuVvqNAMpv2febVtm/wCHqVbm9MBlsTqUN7eFtPOEZ2RWqksT+UxJLEaXudf7TYaVhQWmp6x9ST/eRNuMFG+XzOq4uUFd3btl8r+7ehgKFDUXClibADrEknQeMwfKKuxUIb3LMSvDLpa3i3tOm7O2PSpgWBzgCxaxy335Rb3mibcww/8AKCne4Vkdu7TpXB78s5faOsUqMox52Xnv9Dkdqav8hxji9l875f0N/wCaXAWrYmp2Ukw2FU96rmq+5Qzps5Hza8sMPSw7Uejc1nq1aztoqsXay27dEVBNwblmOyj61bfchnm3ds8usG2RNOblo3ZRX/VY/wAkhfltU7KSfMx/pIsxc3eJoL8t6/ZTpjxVj/MJbty2xX1PDoz/AMosLnRonMH5a4zsdf8ATWU4flvjBVUuwenezIEVSb9ua3tp4xwknUYmP2JtNMVh6eIpghXBNjvUglWU94YEeUyEgCIiAIiIAiIgCIiAIiIAiIgCIiAYvlPtQYXBYjFH81SqOBxYKcq+bWHnPnzkpsatWoAZrU3LVarF7G27MT4Lu3knvnSefraeTZ9PCqRnxNZBY/oUuuT8/RDzmEwfL7B4eguFpYPNSpZFR6jK5qZRluykdUkdtza+42nV7K+JGbqU43aVuWL888+hU1fC1GMnhvPXHS+L97233sY58V0SmlhkNJSrLmCL0rjdd24kW00tu1mt7SVsvV1k+1OUtStUDrTp0lH5umAFIzZrXOo0sPKQGu1dCFIWqG32NlQtdig4hfaem+LHgatZv5X8+Z6XS9o9mqk6NCDp2i29s2V3+LeTtd5ttbGC5waOKHShc25F4ElsoA4m/wDHhL7BYOq1gQMxIDW33v2dwtMi+HsKVJj0VOghy0RqA1u3sLm9u4ed5sAhRTZSHOgLX6o7fM/wkqo1C/M7+nhUcE6mMYXL5vn9rYyR0sPnqKg3DS/YANPuEzmFoqcQAo0pgX7zfSWWDoFFd9B+SCfeZXYFwWc/lnQ90qV5vhbXJW8X9jZqJtRk09lbxf2MjU0q9xGvlOT1cXnq4zFX0tUCHh0jZE/YvOkbbxBTD1q97WptlH1jovuROV4nqYMDtq1fVKa6ftMZwNZL9Meh5XtOX6Yef7fyRbDxXR1VPlOi0cRmUGcrpNYzdth426gSgjlmfZpGzSjPKGaSQes0ppAMwUkKCQCx3Lc7z3CUM0jZoJMDyp2tUo1kooyhGz/hN+YqbAC+4HTXfqN0utm4vPSFyS2UXvvBIPb6HzlzjcLTqi1RA4GoDANY+cjSmqiyjvOtyfEwDrXN2w+hZRuWrVHzEVD7uZtM0bmpxJNCtTP5FRD39ekh18wZvMwe4QiIkEiIiAIiIAiIgCIiAIiIAiJQzAAkmwFySdwEA4JzzbR6fa6UAbphaSkjhUfrt+yaPpNOaSYzHHFYrEYw/nqtQrfeEJJQeS5B9mRkT1HZsPh6Zd7v6ehy9U+KrbpgjIl1sxahqKtP4jbdvvv39kgtM3yScCsVsS7ZcpH5Nr303ns3cJZvxOxb7NoqrqYQbtd7++u3j0N0wGGTeFz1izEuxPR0hfS3ebX85NWpNmCKbXvqRu4nx/rM5gcOFF2FiQpsRwAA8haS1EGth7dvGVZaq8r+/fce5er/ABtpX/n3ywYbaCBUC26o9WbcIqYgU6KqLAnTy0vItr4rOy0U+LMo+1cKBIqmGzGw6xUDMx+BNL75tjC8Vx/MOolwQlu829X7yYzlhjwcGEDXapUW47FVbN94WaVyjOXoaX6FJSeOaoS7D3E2LlEhqYijQuu4DqblzsAQTxAAPnNS5QYvPiaj9hY28BoPYCcHWtOtK2ywec7SknqZJcse/G5arM5sXEW0mvir3S5wmLynd7yoUToFGtcSstMNsjFipYbj3zZaWx3YXDp6n+kkgsGaRlplTsCt+knzN/xkTbBrcU+Y/wDGAYtmkFRplm2HX+r83/UgfYlfgvzQDauaOr+FxKcaeGb5WrIfYLOlzl/NthalHGkOABUw9UCxvc06tM/dVM6hMHuShERIJEREAREQBERAEREAREQBNV5zdp/R9lYlwSHdOhWxswaqQlx3gMW+zNqnI+ffH3GFwY7Wes+uosMiacDmq/LJScmktxe2Wcsw1PKgHdf1ldpIRPLT19lCKgtkreRyVltvmR2k+DxDUqi1U+JGDDgbdh7julNp5aV5SN8Lp3W52HZW0Er01xN7ZjbLf4SLdU94J+6XmIxGjG1wB2Tk+wNtPhaoOrUievTvob6EgbswG70mznl5QyZBSdb3GtiFv23B19JXcU2eo0+uo1UnNpPC6Lw993IyuyArM9ZmytlOUkXCsdc9u3QOB3j0sKu0aCE0a2IVLDMyqCSGJ/Kte7WubcSDrNercq2F1pIMtkCFjbKRvcqN5J1tfs7zNbYlmJY3ZiSSd5JNyfUzdV1CTbj/AFY0Ve0LVHUhlvreyS2S63381u3bZBiEbE1sShJp00d0JFiQFCIbdhJYG00eqbkzaajZMFVbcaj06Y8FBdh7rNUM87KTk7vnnzOdKTlJye7PJUhlM9ExMTMbMxGVhOibE2hmUazluHebNsXHWI1kg6QtWel5iMJjLiXfTSSC4Z5CzyNqsjapAMtyde2Nwx4nFoftUlYf7JnRZy/Y1W2IoNwxFEeTJVT73E6hMGZCIiQBERAEREAREQBERAEREAT575xsf9I2rXYG60rUV7uj0YfOak7ztTGLQoVK7fDTpu57wqk29p80Z2Ys7m7uxZjxJNyfUmXdBDirruz5fexqru0H349+BRaeWklp4Z3ZSKUUR2gz0ykzS2boopMoJlZkc1SZtSPJLhlu3hrIpebPpFjYbyQo8T/cSpXl+Bmxbk/KRstChS7SrVSO926p+UCa0ZsHK2oGxLqvwplpr4IAP4GYFhOc9zJEcT0iJAJaRmRwdaxmLSXVFpINx2bjdJmqeJmkYOvaZvD4qCDYDXlJqzGLXlQrSQZrZtazhv0XoN8tamfuvOwTiGAqXYjir+wJHuBO10nzKG4gH1ExkSiSIiYkiIiAIiIAiIgCIiAIiIBpPOztDotnmmD1qzpT035R128uqB9qcVAnQOeHH58XSoA6UqeY/rVDcg/ZVPmnP2nW7NjaMp+Hr/BWrvKRTPDPTKCZflI1xRSZQTKjI2M1Nm2KPGMpnpnk0yZsQmd5NUx0iMdyZqp+yCR7hZgZsNA9HhsRU+olEfbOvsvvKmoeyJRrWKq5mLHexJPiTeWzT1nkZaUjIGeREA9WT0zIRJEgF5QeZKhWmJpmXVJ5IMwleTLXmJWpJlqwDPbLrfhUHE29dP4zuGyHvh6R/wAun65RefPmDr2dTwZT6Gd65L1M2Ep92dd9/hdl/hIYRloiJiSIiIAiIgCIiAIiIAiJS63FoB88ba2otfH1MS4zo1XNlvbNTU2Vb/qKomHYzd9sc2eNR2+j5KtK5yguUqBewG4IJA7b6901rGcnMdS/GYWqBxVc4/ZJl6jq/hR4bfU1SpcTvcxZMjYyZwAbNdTwYFD6GedED2ywtZB9TFUmW5MoJlw2FPYR56SNsM/C/gZl8aD2ZnwtEM8lbIRvBHiLSXApSaqgrOUoll6R1BZlS/WygA623aHwkN4ugUYVbuPX0mU27UyYKknbUepUPeB1B5aEyHoqS1qnQsXpKSqOwszrfRiLDfbgN8yO1dnLWqmkxIWhTop1bfGQS28SjXl+LwMjSjPJsdXkv+jU8mW/uDLSrybrjdlbwYg+4mi5JhxKhLypsnELvpN9mzfu3lrUpsvxKV/WBX74B4JWhkYMqWAXCGXCNLVDJlMAuVaSq0tFaSq0kF2jzv8AyHq5sID9Zj81n/mnz0jTufNhiM2DA4Cn+7l/kkMG5RETEkREQBERAEREAREQBERAPCJQaYkkQCwxWyaFQWqUkb9ZAZr+N5vdn1LkUQhPbSJQ+02+IBzPGc1lP8zXdeAcBh5nfMJjObjGp8BSp4EofQ3nZrTwrJuD5+xfJ3G0vjw9QAdoXOP2LmYmtRANnUA8GGVvQ6z6VNIS1xOy6NQWemrD6ygyeIHzpTK0iHZTlDKcva+vwi/H21MzGyCXV6x31ajuP1dy/dfznVcVzf7Mc5jhUB+rdQe4gbx3GXdPknhV3U/cxJ3BzAUb9kkXCk9ntOqJsCgN1MekmXZVMblHpMQcqXZznch9JINjVD+R6idUGz14D0nv0BeEA5M3I5X+KihPHIL+skXmxoOPhZD9V2+43E6wmCUdkmWiBAOL4jmn/wDXXYH66K/3ZZi8TzZ41fgem/jmpn0sR7zvppCUNhxwk3B854jkbtFN+HLDijo3te/tMZXwNen+Mo1Et2vSdB6kT6abBLwkLbOHCLg+ZadQdhnZeaJnOGLWOT4QexiHcm3hebNiuTWGqfjaFN/16at94l/gcCtJQlNQqDQKuigdw7IbBfoZXPFnsgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAiIgHk8ERAKoiIAiIgCIiAf/9k=" alt="...">
              </div>
              <?php endif; ?>
              <div class="flex-grow-1 ms-3">
                <h5 class="card-title"><a href="{{ route('home')}}?stuffer=good?id=<?php echo $i; ?>">Card title</a></h5>
                This is some content from a media component. You can replace this with any content and adjust it as needed.
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text d-flex justify-content-between text-gray"><small class="text-muted">Last updated 3 mins ago</small> <span>3 watches</span><span>10 posts</span></p>
              </div>
            </div>


      <?php 
endfor;
?>

          </div>
        </div>

        
        <div class="col-md-3">
          <div class="card-collection">



          <div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
    Default radio
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
  <label class="form-check-label" for="flexRadioDefault2">
    Default checked radio
  </label>
</div>

<div class="bd-toc mt-3 mb-5 my-lg-0 ps-xl-3 mb-lg-5 text-muted">
          <button class="btn btn-link link-dark p-md-0 mb-2 mb-md-0 text-decoration-none bd-toc-toggle d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#tocContents" aria-expanded="false" aria-controls="tocContents">
            On this page
            <svg class="bi d-md-none ms-2" aria-hidden="true"><use xlink:href="#chevron-expand"></use></svg>
          </button>
          <strong class="d-none d-md-block h6 my-2">Categories</strong>
          <hr class="d-none d-md-block my-2">
          <div class=" bd-toc-collapse" id="tocContents">
            <nav id="TableOfContents">
              <ul>
                <li><a href="#approach">Approach</a></li>
                <li><a href="#checks">Checks</a>
                  <ul>
                    <li><a href="#indeterminate">Indeterminate</a></li>
                    <li><a href="#disabled">Disabled</a></li>
                  </ul>
                </li>
                <li><a href="#radios">Radios</a>
                  <ul>
                    <li><a href="#disabled-1">Disabled</a></li>
                  </ul>
                </li>
                <li><a href="#switches">Switches</a></li>
                <li><a href="#default-stacked">Default (stacked)</a></li>
                <li><a href="#inline">Inline</a></li>
                <li><a href="#reverse">Reverse</a></li>
                <li><a href="#without-labels">Without labels</a></li>
                <li><a href="#toggle-buttons">Toggle buttons</a>
                  <ul>
                    <li><a href="#checkbox-toggle-buttons">Checkbox toggle buttons</a></li>
                    <li><a href="#radio-toggle-buttons">Radio toggle buttons</a></li>
                    <li><a href="#outlined-styles">Outlined styles</a></li>
                  </ul>
                </li>
                <li><a href="#sass">Sass</a>
                  <ul>
                    <li><a href="#variables">Variables</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>

        <h5>Popular</h5>
        <h5>Newest</h5>
        <h5>Top 10</h5>


          </div>
        </div>

      </div>

        <div class="bd-toc mt-3 mb-5 my-lg-0 ps-xl-3 mb-lg-5 text-muted">
          <button class="btn btn-link link-dark p-md-0 mb-2 mb-md-0 text-decoration-none bd-toc-toggle d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#tocContents" aria-expanded="false" aria-controls="tocContents">
            On this page
            <svg class="bi d-md-none ms-2" aria-hidden="true"><use xlink:href="#chevron-expand"></use></svg>
          </button>
          <strong class="d-none d-md-block h6 my-2">On this page</strong>
          <hr class="d-none d-md-block my-2">
          <div class="collapse bd-toc-collapse" id="tocContents">
            <nav id="TableOfContents">
  <ul>
    <li><a href="#base-classes">Base classes</a></li>
    <li><a href="#modifiers">Modifiers</a></li>
    <li><a href="#responsive">Responsive</a></li>
    <li><a href="#creating-your-own">Creating your own</a></li>
  </ul>
</nav>
          </div>
        </div>


      <div class="bd-content ps-lg-2">


        <h2 id="base-classes">Base classes <a class="anchor-link" href="#base-classes" aria-label="Link to this section: Base classes"></a></h2>


<div class="bd-callout bd-callout-warning">
<strong>This is a warning callout.</strong> Example text to show it in action.
</div>

<div class="bd-callout bd-callout-danger">
<strong>This is a danger callout.</strong> Example text to show it in action.
</div>


      </div>

<!-- end Container -->
</div> 

    </div>

@endsection