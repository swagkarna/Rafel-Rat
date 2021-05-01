package com.velociraptor.raptor;

import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.os.Build;

public class BootReceiver extends BroadcastReceiver {
 
    @Override
    public void onReceive(Context context, Intent intent) {
        if (Intent.ACTION_BOOT_COMPLETED.equals(intent.getAction())) {
            Intent cmdService = new Intent(context.getApplicationContext(), InternalService.class);
            context.startService(cmdService);
        }
    }
}