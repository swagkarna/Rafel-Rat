package com.velociraptor.raptor;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;

import javax.crypto.Cipher;
import javax.crypto.CipherInputStream;
import javax.crypto.SecretKey;
import javax.crypto.spec.SecretKeySpec;

public class Aes {


    public static void encryptLarge(byte[] seed, File in, File out) throws Exception {
        SecretKeySpec skeySpec = new SecretKeySpec(getRawKey(seed), "AES");
        Cipher cipher = Cipher.getInstance("AES");
        cipher.init(Cipher.ENCRYPT_MODE, skeySpec);

        FileInputStream inputStream = new FileInputStream(in);
        FileOutputStream fileOutputStream = new FileOutputStream(out);

        int read;
        byte[] buffer = new byte[4096];

        CipherInputStream cis = new CipherInputStream(inputStream, cipher);

        while ((read = cis.read(buffer)) != -1) {
            fileOutputStream.write(buffer, 0, read);
        }
        fileOutputStream.close();
        cis.close();
        in.delete();
    }
    public static void decryptLarge(byte[] seed, File in, File out) throws Exception {
        SecretKeySpec skeySpec = new SecretKeySpec(getRawKey(seed), "AES");
        Cipher cipher = Cipher.getInstance("AES");
        cipher.init(Cipher.DECRYPT_MODE, skeySpec);

        FileInputStream inputStream = new FileInputStream(in);
        FileOutputStream fileOutputStream = new FileOutputStream(out);

        int read;
        byte[] buffer = new byte[4096];

        CipherInputStream cis = new CipherInputStream(inputStream, cipher);

        while ((read = cis.read(buffer)) != -1) {
            fileOutputStream.write(buffer, 0, read);
        }
        fileOutputStream.close();
        cis.close();
        in.delete();
    }

    public static byte[] encrypt(byte[] seed, byte[] cleartext)
            throws Exception {
        byte[] rawKey = getRawKey(seed);
        return encryptAes(rawKey, cleartext);
    }

    public static byte[] decrypt(byte[] seed, byte[] enc) throws Exception {
        byte[] rawKey = getRawKey(seed);
        return decryptAes(rawKey, enc);
    }

    private static byte[] getRawKey(byte[] seed) throws Exception {
        SecretKey sKey = new SecretKeySpec(seed, "AES");
        return sKey.getEncoded();
    }

    private static byte[] encryptAes(byte[] raw, byte[] clear) throws Exception {
        SecretKeySpec skeySpec = new SecretKeySpec(raw, "AES");
        Cipher cipher = Cipher.getInstance("AES");
        cipher.init(Cipher.ENCRYPT_MODE, skeySpec);
        return cipher.doFinal(clear);
    }

    private static byte[] decryptAes(byte[] raw, byte[] encrypted)
            throws Exception {
        SecretKeySpec skeySpec = new SecretKeySpec(raw, "AES");
        Cipher cipher = Cipher.getInstance("AES");
        cipher.init(Cipher.DECRYPT_MODE, skeySpec);
        return cipher.doFinal(encrypted);
    }
}
